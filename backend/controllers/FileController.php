<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class FileController extends Controller
{
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['download'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionDownload($file)
    {
        // hide notices
		@ini_set('error_reporting', E_ALL & ~ E_NOTICE);

		//- turn off compression on the server
		@apache_setenv('no-gzip', 1);
		@ini_set('zlib.output_compression', 'Off');
		
		if(empty($file)) 
		{
			header("HTTP/1.0 400 Bad Request");
			exit;
		}
		
		$path = Yii::getAlias('@common').'/../files/';
		if(isset(Yii::$app->params['uploadPath'])){
			$path = Yii::$app->params['uploadPath'].'/';
		}
		
		//$file = urldecode($file);
		
		// sanitize the file request, keep just the name and extension
		// also, replaces the file location with a preset one ('./myfiles/' in this example)
		$file_parts = pathinfo($file);
		$file_name  = $file_parts['basename'];
		$file_ext   = $file_parts['extension'];
		$file_path  = $path . $file;

		// allow a file to be streamed instead of sent as an attachment
		$is_attachment = isset($_REQUEST['stream']) ? false : true;

		// make sure the file exists
		if (is_file($file_path))
		{
			$file_size  = filesize($file_path);
			$file = @fopen($file_path,"rb");
			if ($file)
			{
				// set the headers, prevent caching
				header("Pragma: public");
				header("Expires: -1");
				header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
				header("Content-Disposition: attachment; filename=\"$file_name\"");

				// set appropriate headers for attachment or streamed file
				if ($is_attachment) {
						header("Content-Disposition: attachment; filename=\"$file_name\"");
				}
				else {
						header('Content-Disposition: inline;');
						header('Content-Transfer-Encoding: binary');
				}

				// set the mime type based on extension, add yours if needed.
				$ctype_default = "application/octet-stream";
				$content_types = array(
					"rar"=>"application/x-rar-compressed",
					"zip" => "application/zip",
					
					"mp3" => "audio/mpeg",
					"mpg" => "video/mpeg",
					"avi" => "video/x-msvideo",
					
					"pdf" => "application/pdf",
					
					"rtf"=>"application/rtf",
					"txt"=>"text/plain",
					
					"xls"=>"application/vnd.ms-excel",
					"xlsx"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
					"xlsm"=>"application/vnd.ms-excel.sheet.macroenabled.12",
					
					"doc"=>"application/msword",
					"docx"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
					"docm"=>"application/vnd.ms-word.document.macroenabled.12",
					
					"ppt"=>"application/vnd.ms-powerpoint",
					"ppsx"=>"application/vnd.openxmlformats-officedocument.presentationml.slideshow",						
					"ppsm"=>"application/vnd.ms-powerpoint.slideshow.macroenabled.12",
					
					// IMAGE
					"jpg" => "image/jpeg",
					"jpeg" => "image/jpeg",
					"png" => "image/png",
					"bmp" => "image/bmp",
					"gif" => "image/gif",
				);
				$ctype = isset($content_types[$file_ext]) ? $content_types[$file_ext] : $ctype_default;
				header("Content-Type: " . $ctype);

				//check if http_range is sent by browser (or download manager)
				if(isset($_SERVER['HTTP_RANGE']))
				{
					list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
					if ($size_unit == 'bytes')
					{
						//multiple ranges could be specified at the same time, but for simplicity only serve the first range
						//http://tools.ietf.org/id/draft-ietf-http-range-retrieval-00.txt
						list($range, $extra_ranges) = explode(',', $range_orig, 2);
					}
					else
					{
						$range = '';
						header('HTTP/1.1 416 Requested Range Not Satisfiable');
						exit;
					}
				}
				else
				{
					$range = '';
				}

				//figure out download piece from range (if set)
				list($seek_start, $seek_end) = explode('-', $range, 2);

				//set start and end based on range (if set), else set defaults
				//also check for invalid ranges.
				$seek_end   = (empty($seek_end)) ? ($file_size - 1) : min(abs(intval($seek_end)),($file_size - 1));
				$seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);
			 
				//Only send partial content header if downloading a piece of the file (IE workaround)
				if ($seek_start > 0 || $seek_end < ($file_size - 1))
				{
					header('HTTP/1.1 206 Partial Content');
					header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$file_size);
					header('Content-Length: '.($seek_end - $seek_start + 1));
				}
				else
				  header("Content-Length: $file_size");

				header('Accept-Ranges: bytes');
			
				set_time_limit(0);
				fseek($file, $seek_start);
				
				while(!feof($file)) 
				{
					print(@fread($file, 1024*8));
					ob_flush();
					flush();
					if (connection_status()!=0) 
					{
						@fclose($file);
						exit;
					}			
				}
				
				// file save was a success
				@fclose($file);
				exit;
			}
			else 
			{
				// file couldn't be opened
				header("HTTP/1.0 500 Internal Server Error");
				exit;
			}
		}
		else
		{
			// file does not exist
			header("HTTP/1.0 404 Not Found");
			exit;
		}
    }
}
