<?php

namespace frontend\modules\eregistrasi\trainingclass\controllers;

use Yii;
use frontend\models\TrainingExecutionEvaluation;
use frontend\models\TrainingExecutionEvaluationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainingExecutionEvaluationController implements the CRUD actions for TrainingExecutionEvaluation model.
 */
class TrainingExecutionEvaluationController extends Controller
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
     * Lists all TrainingExecutionEvaluation models.
     * @return mixed
     */
    public function actionIndex($tb_training_id)
    {
        /*$searchModel = new TrainingExecutionEvaluationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		return $this->render('create', [
            'tb_training_id' => $tb_training_id,
        ]);*/	
		$tb_training_class_student_id = \frontend\models\TrainingClassStudent::findOne(['tb_student_id' => Yii::$app->user->identity->id,'tb_training_id'=>base64_decode(\hscstudio\heart\helpers\Kalkun::HexToAscii($tb_training_id))])->id;
		
		if (($model = TrainingExecutionEvaluation::findOne(['tb_training_class_student_id'=>$tb_training_class_student_id])) !== null) 
		{
				return $this->redirect(['view',
						'tb_training_id' => $tb_training_id,		
				]);
		}
		else
		{		return $this->redirect(['create',
						'tb_training_id' => $tb_training_id,		
				]);
		}
    }

    /**
     * Displays a single TrainingExecutionEvaluation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($tb_training_id)
    {
        $tb_training_class_student_id = \frontend\models\TrainingClassStudent::findOne(['tb_student_id' => Yii::$app->user->identity->id,'tb_training_id'=>base64_decode(\hscstudio\heart\helpers\Kalkun::HexToAscii($tb_training_id))])->id;
		return $this->render('view', [
            'model' => $this->findModel($tb_training_class_student_id),
			'tb_training_id' => base64_decode(\hscstudio\heart\helpers\Kalkun::HexToAscii($tb_training_id)),
        ]);
    }

    /**
     * Creates a new TrainingExecutionEvaluation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tb_training_id)
    {
		$id = base64_decode(\hscstudio\heart\helpers\Kalkun::HexToAscii($tb_training_id));
		$model = new TrainingExecutionEvaluation();
		
        if ($model->load(Yii::$app->request->post())){
			
			for($x=1;$x<=33;$x++)
			{
				$model->value[$x];
			}
			$model->value=implode("|",$model->value);
			$model->tb_training_class_student_id = \frontend\models\TrainingClassStudent::findOne(['tb_student_id' => Yii::$app->user->identity->id,'tb_training_id'=>$id])->id;
			$model->status=1;
			if($model->save()) {
				 Yii::$app->session->setFlash('success', 'Data saved');
			}
			else{
				 Yii::$app->session->setFlash('error', 'Unable create there are some error');
			}
            return $this->redirect(['view', 'tb_training_id' => $tb_training_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				//'toke' => 15,
            ]);
        }
    }

    /**
     * Updates an existing TrainingExecutionEvaluation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing TrainingExecutionEvaluation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrainingExecutionEvaluation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainingExecutionEvaluation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainingExecutionEvaluation::findOne(['tb_training_class_student_id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new TrainingExecutionEvaluation; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['TrainingExecutionEvaluation'][$_POST['editableIndex']]);
				$value=$_POST['TrainingExecutionEvaluation'][$_POST['editableIndex']][$name];
				$model2->$name = $value ;
				$model2->save();
				// return JSON encoded output in the below format
				echo \yii\helpers\Json::encode(['output'=>$value, 'message'=>'']);
				// alternatively you can return a validation error
				// echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'Validation error']);
			}
			// else if nothing to do always return an empty JSON encoded output
			else {
				echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
			}
		return;
		}
		// Else return to rendering a normal view
		return $this->render('view', ['model'=>$model]);
	}

	public function actionOpenTbs($filetype='docx'){
		$dataProvider = new ActiveDataProvider([
            'query' => TrainingExecutionEvaluation::find(),
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
			$OpenTBS->VarRef['modelName']= "TrainingExecutionEvaluation";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'tb_training_class_student_id';			
			$data1[]['col2'] = 'value';			
			$data1[]['col3'] = 'text1';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $trainingexecutionevaluation){
				$data2[] = [
					'col0'=>$trainingexecutionevaluation->id,
					'col1'=>$trainingexecutionevaluation->tb_training_class_student_id,
					'col2'=>$trainingexecutionevaluation->value,
					'col3'=>$trainingexecutionevaluation->text1,
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
            'query' => TrainingExecutionEvaluation::find(),
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
								->setCellValue('A1', 'Tabel TrainingExecutionEvaluation');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingexecutionevaluation){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingexecutionevaluation->id)
													  ->setCellValue('B'.$idx, $trainingexecutionevaluation->tb_training_class_student_id)
													  ->setCellValue('C'.$idx, $trainingexecutionevaluation->value)
													  ->setCellValue('D'.$idx, $trainingexecutionevaluation->text1);
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
								->setCellValue('A1', 'Tabel TrainingExecutionEvaluation');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingexecutionevaluation){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingexecutionevaluation->id)
													  ->setCellValue('B'.$idx, $trainingexecutionevaluation->tb_training_class_student_id)
													  ->setCellValue('C'.$idx, $trainingexecutionevaluation->value)
													  ->setCellValue('D'.$idx, $trainingexecutionevaluation->text1);
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
									->setCellValue('A1', 'Tabel TrainingExecutionEvaluation');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $trainingexecutionevaluation){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingexecutionevaluation->id)
														  ->setCellValue('B'.$idx, $trainingexecutionevaluation->tb_training_class_student_id)
														  ->setCellValue('C'.$idx, $trainingexecutionevaluation->value)
														  ->setCellValue('D'.$idx, $trainingexecutionevaluation->text1);
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
