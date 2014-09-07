<?php

namespace backend\modules\bdk\execution\controllers;

use Yii;
use backend\models\Training;
use backend\models\TrainingClass;
use backend\models\TrainingClassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TrainingClassController implements the CRUD actions for TrainingClass model.
 */
class TrainingClassController extends Controller
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





    public function actionIndex($trainingId)
    {
        $searchModel = new TrainingClassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$queryParams['TrainingClassSearch']=[
			'tb_training_id'=>$trainingId,
		];

		$queryParams = ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);

		// Klo classcount di training ada isinya
		if (Training::findOne($trainingId)->classCount != null or Training::findOne($trainingId)->classCount != 0) {
			// Ambil jumlah kelas yg ada
			$classCount = TrainingClass::find()->where([
				'tb_training_id' => $trainingId
			])->count();
		}
		else {
			// Klo ga ada, artinya ga boleh nampilin auto generate class, kita kasih nilai -1
			$classCount = -1;
		}

		$currentTraining = Training::findOne($trainingId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'currentTraining' => $currentTraining,
            'classCount' => $classCount
        ]);
    }



    public function actionAuto($trainingId) {
    	// Cek ada classCount ga
    	$cc = Training::find()->where(['id' => $trainingId])->one()->classCount;
    	if ($cc == 0) {
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Class count should not empty!');
    		return $this->redirect(['index', 'trainingId' => $trainingId]);
    	}

    	// Mbikin class berdasarkan classcount
    	$sukses = 0;
    	for ($i = 1; $i <= $cc; $i++) {
    		$model = new TrainingClass;
    		$model->tb_training_id = $trainingId;
    		$model->class = $this->generateClass($i);
    		$model->status = 1;
    		$model->save();
    		$sukses += 1;
    	}

    	Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> '.$sukses.' classes added!');
    	return $this->redirect(['index', 'trainingId' => $trainingId]);
    }




    private function generateClass($noUrut) {
    	// Cek, $noUrut diatas 26
    	if ($noUrut > 26) {
    		
    		// Ngambil hasil bagi dibulatkan ketas
    		$nilaiBagi = round($noUrut / 26, 0, PHP_ROUND_HALF_DOWN);

    		// Ngambil hasil sisa pembagian
    		$nilaiSisa = $noUrut % 26;

    		// Yok bikin nama kelas
    		// Jadi klo noUrutnya lebih dari 26, dia bakal ngulang dari abjad awal, kyk AA, AAA dst
    		$out = '';
    		for ($i = 0; $i < $nilaiBagi; $i++) {
    			$out .= chr(65);
    		}
    		$out .= chr($nilaiSisa + 64);
    		return $out;
    	}
    	else {
    		return chr($noUrut + 64);
    	}
    }





    public function actionView($id)
    {
    	$model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'trainingId' => $model->tb_training_id
        ]);
    }

    



    public function actionCreate()
    {
        $model = new TrainingClass();

        if ($model->load(Yii::$app->request->post())){
			if($model->save()) {
				Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> Class added!');
			}
			else{
				Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Unable to add class');
			}
            return $this->redirect(['index', 'trainingId' => $model->tb_training_id]);
        } 
        else {
        	if (Yii::$app->request->isAjax)
			{
	            return $this->renderAjax('create', [
	                'model' => $model,
	                'trainingId' => Training::findOne(Yii::$app->request->get('trainingId'))->id
	            ]);
			}
			else
			{
	            return $this->render('create', [
	                'model' => $model,
	                'trainingId' => Training::findOne(Yii::$app->request->get('trainingId'))->id
	            ]);
			}
        }
    }





    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
			
            if($model->save()){
				Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> Data saved');
                return $this->redirect(['index', 'trainingId' => $model->tb_training_id]);
            } else {
                Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Failed to save changes!');
				return $this->redirect(['index', 'trainingId' => $model->tb_training_id]);
            }            
        }
		else {
			if (Yii::$app->request->isAjax)
			{
	            return $this->renderAjax('update', [
	                'model' => $model,
	                'trainingId' => $model->tb_training_id
	            ]);
			}
			else
			{
	            return $this->render('update', [
	                'model' => $model,
	                'trainingId' => $model->tb_training_id
	            ]);
			}
		}
    }






    public function actionDelete($id)
    {
    	$trainingId = TrainingClass::findOne($id)->tb_training_id;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'trainingId' => $trainingId]);
    }

    /**
     * Finds the TrainingClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainingClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainingClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new TrainingClass; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['TrainingClass'][$_POST['editableIndex']]);
				$value=$_POST['TrainingClass'][$_POST['editableIndex']][$name];
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
            'query' => TrainingClass::find(),
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
			$OpenTBS->VarRef['modelName']= "TrainingClass";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'tb_training_id';			
			$data1[]['col2'] = 'class';			
			$data1[]['col3'] = 'status';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $trainingclass){
				$data2[] = [
					'col0'=>$trainingclass->id,
					'col1'=>$trainingclass->tb_training_id,
					'col2'=>$trainingclass->class,
					'col3'=>$trainingclass->status,
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
            'query' => TrainingClass::find(),
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
								->setCellValue('A1', 'Tabel TrainingClass');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingclass){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclass->id)
													  ->setCellValue('B'.$idx, $trainingclass->tb_training_id)
													  ->setCellValue('C'.$idx, $trainingclass->class)
													  ->setCellValue('D'.$idx, $trainingclass->status);
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
								->setCellValue('A1', 'Tabel TrainingClass');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingclass){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclass->id)
													  ->setCellValue('B'.$idx, $trainingclass->tb_training_id)
													  ->setCellValue('C'.$idx, $trainingclass->class)
													  ->setCellValue('D'.$idx, $trainingclass->status);
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
									->setCellValue('A1', 'Tabel TrainingClass');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $trainingclass){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclass->id)
														  ->setCellValue('B'.$idx, $trainingclass->tb_training_id)
														  ->setCellValue('C'.$idx, $trainingclass->class)
														  ->setCellValue('D'.$idx, $trainingclass->status);
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
	
	public function actionImport(){
		$dataProvider = new ActiveDataProvider([
            'query' => TrainingClass::find(),
        ]);
		
		/* 
		Please read guide of upload https://github.com/yiisoft/yii2/blob/master/docs/guide/input-file-upload.md
		maybe I do mistake :)
		*/		
		if (!empty($_FILES)) {
			$importFile = \yii\web\UploadedFile::getInstanceByName('importFile');
			if(!empty($importFile)){
				$fileTypes = ['xls','xlsx']; // File extensions allowed
				//$ext = end((explode(".", $importFile->name)));
				$ext=$importFile->extension;
				if(in_array($ext,$fileTypes)){
					$inputFileType = \PHPExcel_IOFactory::identify($importFile->tempName );
					$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
					$objPHPExcel = $objReader->load($importFile->tempName );
					$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					$baseRow = 2;
					$inserted=0;
					$read_status = false;
					$err=[];
					while(!empty($sheetData[$baseRow]['A'])){
						$read_status = true;
						$abjadX=array();
						//$id=  $sheetData[$baseRow]['A'];
						$tb_training_id=  $sheetData[$baseRow]['B'];
						$class=  $sheetData[$baseRow]['C'];
						$status=  $sheetData[$baseRow]['D'];
						//$created=  $sheetData[$baseRow]['E'];
						//$createdBy=  $sheetData[$baseRow]['F'];
						//$modified=  $sheetData[$baseRow]['G'];
						//$modifiedBy=  $sheetData[$baseRow]['H'];
						//$deleted=  $sheetData[$baseRow]['I'];
						//$deletedBy=  $sheetData[$baseRow]['J'];

						$model2=new TrainingClass;
						//$model2->id=  $id;
						$model2->tb_training_id=  $tb_training_id;
						$model2->class=  $class;
						$model2->status=  $status;
						//$model2->created=  $created;
						//$model2->createdBy=  $createdBy;
						//$model2->modified=  $modified;
						//$model2->modifiedBy=  $modifiedBy;
						//$model2->deleted=  $deleted;
						//$model2->deletedBy=  $deletedBy;

						try{
							if($model2->save()){
								$inserted++;
							}
							else{
								foreach ($model2->errors as $error){
									$err[]=($baseRow-1).'. '.implode('|',$error);
								}
							}
						}
						catch (\yii\base\ErrorException $e){
							Yii::$app->session->setFlash('error', "{$e->getMessage()}");
							//$this->refresh();
						} 
						$baseRow++;
					}	
					Yii::$app->session->setFlash('success', ($inserted).' row inserted');
					if(!empty($err)){
						Yii::$app->session->setFlash('warning', 'There are error: <br>'.implode('<br>',$err));
					}
				}
				else{
					Yii::$app->session->setFlash('error', 'Filetype allowed only xls and xlsx');
				}				
			}
			else{
				Yii::$app->session->setFlash('error', 'File import empty!');
			}
		}
		else{
			Yii::$app->session->setFlash('error', 'File import empty!');
		}
		
		return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);					
	}
}
