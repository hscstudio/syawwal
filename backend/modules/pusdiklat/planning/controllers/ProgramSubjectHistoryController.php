<?php

namespace backend\modules\pusdiklat\planning\controllers;

use Yii;
use backend\models\ProgramSubjectHistory;
use backend\models\ProgramSubjectHistorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramSubjectHistoryController implements the CRUD actions for ProgramSubjectHistory model.
 */
class ProgramSubjectHistoryController extends Controller
{
		public $layout = '@hscstudio/heart/views/layouts/column2';
	 
 	
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProgramSubjectHistory models.
     * @return mixed
     */
    public function actionIndex($tb_program_id,$revision)
    {
        $searchModel = new ProgramSubjectHistorySearch();
        $queryParams = Yii::$app->request->getQueryParams();
		$queryParams['ProgramSubjectHistorySearch']=['tb_program_id'=>$tb_program_id,'revision'=>$revision,];
		$dataProvider = $searchModel->search($queryParams);
		
		$model1=\backend\models\ProgramHistory::find()->where([
			'tb_program_id'=>$tb_program_id,
			'revision'=>$revision
		])->one();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'tb_program_id' => $tb_program_id,
			'revision' => $revision,
			'program_name'=> $model1->name,
        ]);
    }

    /**
     * Displays a single ProgramSubjectHistory model.
     * @param integer $tb_program_subject_id
     * @param integer $tb_program_id
     * @param integer $revision
     * @return mixed
     */
    public function actionView($tb_program_subject_id, $tb_program_id, $revision)
    {
		$model = $this->findModel($tb_program_subject_id, $tb_program_id, $revision);
		
		$model1=\backend\models\ProgramHistory::find()->where([
			'tb_program_id'=>$tb_program_id,
			'revision'=>$revision
		])->one();
		
        return $this->render('view', [
            'model' => $model,
			'tb_program_id' => $tb_program_id,
			'revision' => $revision,
			'program_name'=> $model1->name,
			'program_subject_name'=> $model->name,
        ]);
    }

    
    /**
     * Finds the ProgramSubjectHistory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $tb_program_subject_id
     * @param integer $tb_program_id
     * @param integer $revision
     * @return ProgramSubjectHistory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tb_program_subject_id, $tb_program_id, $revision)
    {
        if (($model = ProgramSubjectHistory::findOne(['tb_program_subject_id' => $tb_program_subject_id, 'tb_program_id' => $tb_program_id, 'revision' => $revision])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionOpenTbs($filetype='docx'){
		$dataProvider = new ActiveDataProvider([
            'query' => ProgramSubjectHistory::find(),
        ]);
		
		try {
			$templates=[
				'docx'=>'ms-word.docx',
				'odt'=>'open-document.odt',
				'xlsx'=>'ms-excel.xlsx'
			];
			// Initalize the TBS instance
			$OpenTBS = new \hscstudio\heart\extensions\OpenTBS; // new instance of TBS
			// Change with Your template kaka
			$template = Yii::getAlias('@hscstudio/heart').'/extensions/opentbs-template/'.$templates[$filetype];
			$OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
			$OpenTBS->VarRef['modelName']= "ProgramSubjectHistory";
			$data1[]['col0'] = 'tb_program_subject_id';			
			$data1[]['col1'] = 'tb_program_id';			
			$data1[]['col2'] = 'revision';			
			$data1[]['col3'] = 'type';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $programsubjecthistory){
				$data2[] = [
					'col0'=>$programsubjecthistory->tb_program_subject_id,
					'col1'=>$programsubjecthistory->tb_program_id,
					'col2'=>$programsubjecthistory->revision,
					'col3'=>$programsubjecthistory->type,
				];
			}
			$OpenTBS->MergeBlock('b', $data2);
			// Output the result as a file on the server. You can change output file
			$OpenTBS->Show(OPENTBS_DOWNLOAD, 'result.'.$filetype); // Also merges all [onshow] automatic fields.			
			exit;
		} catch (\yii\base\ErrorException $e) {
			 Yii::$app->session->setFlash('error', 'Unable export there are some error');
		}	
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);		
	}	
	
	public function actionPhpExcel($filetype='xlsx',$template='yes',$engine='')
    {
		$dataProvider = new ActiveDataProvider([
            'query' => ProgramSubjectHistory::find(),
        ]);
		
		try {
			if($template=='yes'){
				// only for filetypr : xls & xlsx
				if(in_array($filetype,['xlsx','xls'])){
					$types=['xls'=>'Excel5','xlsx'=>'Excel2007'];
					$objReader = \PHPExcel_IOFactory::createReader($types[$filetype]);
					$template = Yii::getAlias('@hscstudio/heart').'/extensions/phpexcel-template/ms-excel.'.$filetype;
					$objPHPExcel = $objReader->load($template);
					$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
					$objPHPExcel->getProperties()->setTitle("PHPExcel in Yii2Heart");
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A1', 'Tabel ProgramSubjectHistory');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $programsubjecthistory){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubjecthistory->tb_program_subject_id)
													  ->setCellValue('B'.$idx, $programsubjecthistory->tb_program_id)
													  ->setCellValue('C'.$idx, $programsubjecthistory->revision)
													  ->setCellValue('D'.$idx, $programsubjecthistory->type);
						$idx++;
					}		
					
					// Redirect output to a client’s web browser
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="result.'.$filetype.'"');
					header('Cache-Control: max-age=0');
					$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, $types[$filetype]);
					$objWriter->save('php://output');
					exit;
				}
				else{
					Yii::$app->session->setFlash('error', 'Unfortunately pdf not support, only for excel');
				}
			}
			else{
				if(in_array($filetype,['xlsx','xls'])){
					$types=['xls'=>'Excel5','xlsx'=>'Excel2007'];
					// Create new PHPExcel object
					$objPHPExcel = new \PHPExcel();
					$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(\PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
					$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(\PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
					$objPHPExcel->getProperties()->setTitle("PHPExcel in Yii2Heart");
					$objPHPExcel->setActiveSheetIndex(0)
								->setCellValue('A1', 'Tabel ProgramSubjectHistory');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $programsubjecthistory){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubjecthistory->tb_program_subject_id)
													  ->setCellValue('B'.$idx, $programsubjecthistory->tb_program_id)
													  ->setCellValue('C'.$idx, $programsubjecthistory->revision)
													  ->setCellValue('D'.$idx, $programsubjecthistory->type);
						$idx++;
					}		
									
					// Redirect output to a client’s web browser (Excel2007)
					if($filetype=='xlsx')
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					// Redirect output to a client’s web browser (Excel5)
					if($filetype=='xls')
					header('Content-Type: application/vnd.ms-excel');

					header('Content-Disposition: attachment;filename="result.'.$filetype.'"');
					header('Cache-Control: max-age=0');
					// If you're serving to IE 9, then the following may be needed
					header('Cache-Control: max-age=1');

					// If you're serving to IE over SSL, then the following may be needed
					header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
					header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
					header ('Pragma: public'); // HTTP/1.0

					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $types[$filetype]);
					$objWriter->save('php://output');
					exit;				
				}
				else if(in_array($filetype,['pdf'])){
					if(in_array($engine,['tcpdf','mpdf',''])){
						$types=['xls'=>'Excel5','xlsx'=>'Excel2007'];
						if($engine=='tcpdf' or $engine==''){
							$rendererName = \PHPExcel_Settings::PDF_RENDERER_TCPDF;
							$rendererLibraryPath = Yii::getAlias('@hscstudio/heart').'/libraries/tcpdf';
						}
						else if($engine=='mpdf'){
							$rendererName = \PHPExcel_Settings::PDF_RENDERER_MPDF;
							$rendererLibraryPath = Yii::getAlias('@hscstudio/heart').'/libraries/mpdf';
						}
						// Create new PHPExcel object
						$objPHPExcel = new \PHPExcel();
						
						$objPHPExcel->getProperties()->setTitle("PHPExcel in Yii2Heart");
						$objPHPExcel->setActiveSheetIndex(0)
									->setCellValue('A1', 'Tabel ProgramSubjectHistory');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $programsubjecthistory){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubjecthistory->tb_program_subject_id)
														  ->setCellValue('B'.$idx, $programsubjecthistory->tb_program_id)
														  ->setCellValue('C'.$idx, $programsubjecthistory->revision)
														  ->setCellValue('D'.$idx, $programsubjecthistory->type);
							$idx++;
						}		
						
						if (!\PHPExcel_Settings::setPdfRenderer(
							$rendererName,
							$rendererLibraryPath
						)){
							Yii::$app->session->setFlash('error', 
								'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
								'<br />' .
								'at the top of this script as appropriate for your directory structure'
							);
						}
						else{
							// Redirect output to a client’s web browser (PDF)
							header('Content-Type: application/pdf');
							header('Content-Disposition: attachment;filename="result.pdf"');
							header('Cache-Control: max-age=0');

							$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
							$objWriter->save('php://output');
							exit;
						}
					}
					else{
						Yii::$app->session->setFlash('error', 'Unfortunately this engine not support');
					}
				}
				else{
					Yii::$app->session->setFlash('error', 'Unfortunately filetype not support, only for excel & pdf');
				}
			}
        } catch (\yii\base\ErrorException $e) {
			 Yii::$app->session->setFlash('error', 'Unable export there are some error');
		}	
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);	
    }
	
}
