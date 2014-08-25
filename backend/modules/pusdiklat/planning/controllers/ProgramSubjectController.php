<?php

namespace backend\modules\pusdiklat\planning\controllers;

use Yii;
use backend\models\ProgramSubject;
use backend\models\ProgramSubjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramSubjectController implements the CRUD actions for ProgramSubject model.
 */
class ProgramSubjectController extends Controller
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
     * Lists all ProgramSubject models.
     * @return mixed
     */
    public function actionIndex($tb_program_id,$status=1)
    {
         if(isset($tb_program_id)){
			$searchModel = new ProgramSubjectSearch();
			$queryParams = Yii::$app->request->getQueryParams();			
			if($status!='all'){
				$queryParams['ProgramSubjectSearch']=[
					'tb_program_id'=>$tb_program_id,
					'status'=>$status,
				];
			}
			else{
				$queryParams['ProgramSubjectSearch']=[
					'tb_program_id'=>$tb_program_id,					
				];
			}
			$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
			$dataProvider = $searchModel->search($queryParams);
			
			$model1 = \backend\models\Program::findOne($tb_program_id);
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'tb_program_id' => $tb_program_id,
				'status' => $status,
				'program_name'=>$model1->name,
			]);
		}
		else{
			return $this->redirect(['program/index']);
		}
    }

    /**
     * Displays a single ProgramSubject model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model=$this->findModel($id);
        $model1 = \backend\models\Program::findOne($model->tb_program_id);
		return $this->render('view', [
            'model' => $model,
			'program_name'=>$model1->name,
        ]);
    }

    /**
     * Finds the ProgramSubject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProgramSubject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramSubject::findOne($id)) !== null) {
            if($model->program->ref_satker_id==Yii::$app->user->identity->employee->ref_satker_id){
				return $model;
			}
			else{
				throw new NotFoundHttpException('The requested page does not exist.');
			}
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionOpenTbs($filetype='docx'){
		$dataProvider = new ActiveDataProvider([
            'query' => ProgramSubject::find(),
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
			$OpenTBS->VarRef['modelName']= "ProgramSubject";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'tb_program_id';			
			$data1[]['col2'] = 'type';			
			$data1[]['col3'] = 'name';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $programsubject){
				$data2[] = [
					'col0'=>$programsubject->id,
					'col1'=>$programsubject->tb_program_id,
					'col2'=>$programsubject->type,
					'col3'=>$programsubject->name,
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
            'query' => ProgramSubject::find(),
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
								->setCellValue('A1', 'Tabel ProgramSubject');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $programsubject){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubject->id)
													  ->setCellValue('B'.$idx, $programsubject->tb_program_id)
													  ->setCellValue('C'.$idx, $programsubject->type)
													  ->setCellValue('D'.$idx, $programsubject->name);
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
								->setCellValue('A1', 'Tabel ProgramSubject');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $programsubject){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubject->id)
													  ->setCellValue('B'.$idx, $programsubject->tb_program_id)
													  ->setCellValue('C'.$idx, $programsubject->type)
													  ->setCellValue('D'.$idx, $programsubject->name);
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
									->setCellValue('A1', 'Tabel ProgramSubject');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $programsubject){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $programsubject->id)
														  ->setCellValue('B'.$idx, $programsubject->tb_program_id)
														  ->setCellValue('C'.$idx, $programsubject->type)
														  ->setCellValue('D'.$idx, $programsubject->name);
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
