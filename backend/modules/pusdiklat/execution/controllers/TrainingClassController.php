<?php

namespace backend\modules\pusdiklat\execution\controllers;

use Yii;
use backend\models\TrainingClass;
use backend\models\TrainingClassSearch;
use backend\models\Training;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

    /**
     * Lists all TrainingClass models.
     * @return mixed
     */
    public function actionIndex($tb_training_id)
    {
        $searchModel = new TrainingClassSearch(); 
		$queryParams['TrainingClassSearch']=[				
			'tb_training_id'=>$tb_training_id,
		];
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams); 
		
		$training=\backend\models\Training::findOne($tb_training_id);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'training' => $training, 
        ]);
    }

    /**
     * Displays a single TrainingClass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrainingClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tb_training_id)
    {
        $ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$training=\backend\models\Training::findOne($tb_training_id);
		if($ref_satker_id!=$training->ref_satker_id) die('Invalid request');
		$classCount1=$training->classCount;
		$classCount2=TrainingClass::find()->where(['tb_training_id' => $tb_training_id])->count();
		$createClass = $classCount1 - $classCount2;
		// x = 1 - 0 = 1
		// start = 0
		// finish = 0+x-1
		if($createClass>0){
			$start = $classCount2;
			$finish = $classCount2+$createClass-1;
			$classes = \hscstudio\heart\helpers\Heart::abjad($start,$finish);
			$created=0;
			$failed=0;
			foreach($classes as $class){
				echo "<br>".$class;
				$model = new TrainingClass();
				$model->tb_training_id = $tb_training_id;
				$model->class = $class;
				$model->status = 1;
				if($model->save()){
					$created++;
				}
				else{
					$failed++;
				}				
			}
			
			if($failed>0){
				Yii::$app->session->setFlash('warning', $created.' class created but '.$failed.' class failed');
			}
			else{
				Yii::$app->session->setFlash('success', $created.' class created');
			}
		}
		else{
			Yii::$app->session->setFlash('warning', 'No class created');
		}
		
		return $this->redirect(['index', 'tb_training_id' => $tb_training_id]);
    }

    /**
     * Updates an existing TrainingClass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currentFiles=[];
        
        if ($model->load(Yii::$app->request->post())) {
            $files=[];
			
            if($model->save()){
				$idx=0;
                foreach($files as $file){
					if(isset($paths[$idx])){
						$file->saveAs($paths[$idx]);
					}
					$idx++;
				}
				Yii::$app->session->setFlash('success', 'Data saved');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
				Yii::$app->session->setFlash('error', 'There are some errors');
            }            
        }
		else{
			//return $this->render(['update', 'id' => $model->id]);
			return $this->render('update', [
                'model' => $model,
            ]);
		}
    }

    /**
     * Deletes an existing TrainingClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$tb_training_id=$model->tb_training_id;
		$model->delete();

        return $this->redirect(['index','tb_training_id'=>$tb_training_id]);
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
	
	/**
     * Lists all Room models.
     * @return mixed
     */
    public function actionSchedule($tb_training_class_id,$start="",$finish="")
    {
		$trainingClass=$this->findModel($tb_training_class_id);
		if(empty($start)){
			$start = $trainingClass->training->start;
		}
		
		if(empty($finish) or $finish<$start){
			$finish = $start;
		}
		$searchModel = new \backend\models\TrainingScheduleSearch();
		$queryParams['TrainingScheduleSearch']=[				
			'tb_training_class_id'=>$tb_training_class_id,
			'startDate'=>$start,
			'finishDate'=>$finish,
		];		
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
        $dataProvider = $searchModel->search($queryParams);
		$dataProvider->getSort()->defaultOrder = ['startTime'=>SORT_ASC,'finishTime'=>SORT_ASC];

		// GET ALL TRAINING YEAR
		/*
		$satkers['all']='All';
		$satkers = yii\helpers\ArrayHelper::map(\backend\models\Satker::find()
			//->select(['year'=>'YEAR(start)','start','finish'])
			->orderBy(['eselon'=>'ASC',])
			//->active()
			->asArray()
			->all(), 'id', 'name');
		*/
		if (Yii::$app->request->isAjax){
			return $this->renderAjax('schedule', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'trainingClass'=>$trainingClass,
				'start'=>$start,
				'finish'=>$finish,
			]);
		}
		else{
			return $this->render('schedule', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'trainingClass'=>$trainingClass,
				'start'=>$start,
				'finish'=>$finish,
			]);
		}
    }
	
	public function actionGetMaxTime($tb_training_class_id,$start=""){
		$start = date('Y-m-d',strtotime($start)); 
		$finish =  date('Y-m-d',(strtotime($start)+ 60*60*24));
		$trainingSchedule = \backend\models\TrainingSchedule::find()
				->where('
					(
						startTime >= :start AND 
						finishTime <= :finish
					)
					AND 
					tb_training_class_id = :tb_training_class_id
					AND
					status = :status
				',
				[
					':start' => $start,
					':finish' => $finish,
					':tb_training_class_id' => $tb_training_class_id,
					':status' => 1,
				])
				->orderBy('finishTime DESC')
				->one();
		if($trainingSchedule!=null)
			return date('H:i',strtotime($trainingSchedule->finishTime));		
		else
			return '08:00';		
	}
	
	public function actionAddActivity($tb_training_class_id) 
    { 		
		if (Yii::$app->request->isAjax){
			// PREPARING DATA
			$post = Yii::$app->request->post('TrainingScheduleExtSearch');
			$start = date('Y-m-d H:i',strtotime($post['startDate'].' '.$post['startTime'])); 
			$tb_training_class_subject_id = $post['tb_training_class_subject_id'];
			$tb_activity_room_id =  $post['tb_activity_room_id'];
			$activity = "";
			$pic = "";
			$hours = 0;
			$minutes = 0;
			
			//CHECKING SATKER
			$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
			$trainingClass = \backend\models\TrainingClass::findOne($tb_training_class_id);
			if ($ref_satker_id!=$trainingClass->training->ref_satker_id){
				die('|0|You have not privileges');
			}
			
			if(empty($tb_training_class_subject_id) or $tb_training_class_subject_id==0){
				die('|0|You must select activity!');
			}
			else if ($tb_training_class_subject_id>0){
				$hours = $post['hours'];
				if($hours>0){
					$minutes = (int)($hours * 45);
				}
				else{
					die('|0|Hours have more than 0');
				}
			}
			else{
				$minutes = (int)$post['minutes'];
				if($minutes>0){
					$activity = $post['activity'];
					$pic = $post['pic'];
				}
				else{
					die('|0|Minutes have more than 0');
				}
			}
			$tb_training_class_subject_id=(int)$tb_training_class_subject_id;
			$finish = date('Y-m-d H:i',strtotime($start)+($minutes*60));
			$tb_activity_room_id=(int)$tb_activity_room_id;
			// CHECKING CONSTRAIN TIME
			$startSearch = $start + 60; // [08:00 - 09:00, 09:00 - 10:00] not excact between :)
			$finishSearch = $finish - 60;
			$trainingSchedule = \backend\models\TrainingSchedule::find()
				->where('
					((startTime between :start AND :finish)
						OR (finishTime between :start AND :finish))
					AND 
					tb_training_class_id = :tb_training_class_id
					AND
					status = :status
				',
				[
					':start' => $startSearch,
					':finish' => $finishSearch,
					':tb_training_class_id' => $tb_training_class_id,
					':status' => 1,
				]);
				
			// IS NOT CONSTRAIN			
			if($trainingSchedule->count()==0){ 
				// PREPARING SAVE
				$model = new \backend\models\TrainingSchedule(); 
				$model->tb_training_class_id=$tb_training_class_id;
				$model->tb_training_class_subject_id = $tb_training_class_subject_id;
				$model->tb_activity_room_id = $tb_activity_room_id;		
				$model->activity = $activity;
				$model->pic = $pic;
				$model->hours = $hours;
				$model->startTime = $start;
				$model->finishTime = $finish;
				$model->session = 1;
				$model->status = 1;
			
				if($model->save()) {
					Yii::$app->session->setFlash('success', 'Activity have Added');
					die('|1|Activity have Added|'.date('Y-m-d',strtotime($start)).'|'.date('H:i',strtotime($finish)));
					
				}
				else{
					die('|0|There are some error');
				}
			}
			else{
				die('|0|Constrain time, please change time!');
			}
		}
		else{
			Yii::$app->session->setFlash('error', 'Only for ajax request');
			return $this->redirect(['schedule', 'tb_training_class_id' => $tb_training_class_id]);
		}
    } 

	public function actionDeleteActivity($id,$tb_training_class_id)
    {
		if (Yii::$app->request->isAjax){
			//CHECKING SATKER
			$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
			$trainingClass = \backend\models\TrainingClass::findOne($tb_training_class_id);
			if ($ref_satker_id!=$trainingClass->training->ref_satker_id){
				die('|0|You have not privileges');
			}
			
			$trainingSchedule = \backend\models\TrainingSchedule::find()->where([
				'id'=>$id,
				'tb_training_class_id'=>$tb_training_class_id,
			])->one();
			$start = $trainingSchedule->startTime;
			if($trainingSchedule->delete()) {
				Yii::$app->session->setFlash('success', 'Delete activity success');
				die('|1|Activity have deleted|'.date('Y-m-d',strtotime($start)).'|'.date('H:i',strtotime($start)));
			}
			else{
				die('|0|There are some error');
			}
		}
		else{
			Yii::$app->session->setFlash('error', 'Only for ajax request');
			return $this->redirect(['schedule', 'tb_training_class_id' => $tb_training_class_id]);
		}		
		
    }
	
	public function actionSession($id)
    {
        if (Yii::$app->request->isAjax){
			$model = \backend\models\TrainingSchedule::findOne($id);
			if ($model->load(Yii::$app->request->post())) {				
				if($model->save()) {
					Yii::$app->session->setFlash('success', 'Session have set');
					die('|1|Session have set|'.date('Y-m-d',strtotime($model->startTime)).'|'.date('H:i',strtotime($model->finishTime)));
					
				}
				else{
					die('|0|There are some error');
				}
			}
			else{
				return $this->renderAjax('session', [
					'model' => $model,
				]);
			}
		}
    }
	
	public function actionRoom($id)
    {
        if (Yii::$app->request->isAjax){
			$model = \backend\models\TrainingSchedule::findOne($id);
			if ($model->load(Yii::$app->request->post())) {				
				if($model->save()) {
					Yii::$app->session->setFlash('success', 'Room have set');
					die('|1|Room have set|'.date('Y-m-d',strtotime($model->startTime)).'|'.date('H:i',strtotime($model->finishTime)));
					
				}
				else{
					die('|0|There are some error');
				}
			}
			else{
				return $this->renderAjax('room', [
					'model' => $model,
				]);
			}
		}
    }
	
	public function actionTrainer($id)
    {
        if (Yii::$app->request->isAjax){
			$model = new \backend\models\TrainingScheduleTrainer();
			$trainingSchedule = \backend\models\TrainingSchedule::findOne($id);
			if ($model->load(Yii::$app->request->post())) {
				$tb_trainer_id_array = Yii::$app->request->post('tb_trainer_id_array');
				
				$insert=0;
				foreach($tb_trainer_id_array as $tb_trainer_id=>$on){
					$model2 = new \backend\models\TrainingScheduleTrainer();
					$model2->tb_training_schedule_id = $id;
					$trainingSubjectTrainerRecommendation=\backend\models\TrainingSubjectTrainerRecommendation::find()
					->where([
						'tb_training_id'=>$trainingSchedule->trainingClassSubject->trainingClass->tb_training_id,
						'tb_program_subject_id'=>$trainingSchedule->trainingClassSubject->tb_program_subject_id,
						'tb_trainer_id'=>$tb_trainer_id,
						'status'=>1,
					])
					->one();
					$model2->ref_trainer_type_id=$trainingSubjectTrainerRecommendation->ref_trainer_type_id;
					$model2->tb_trainer_id = $tb_trainer_id;
					$model2->status = 1;
					if($model2->save()) {
						$insert++;
					}
					else{
						die('|0|There are some error'.print_r($model2->errors));
					}
				}
				
				if($insert>0) {
					Yii::$app->session->setFlash('success', 'Trainer have added');
					die('|1|Trainer have added|'.date('Y-m-d',strtotime($trainingSchedule->startTime)).'|'.date('H:i',strtotime($trainingSchedule->finishTime)));
				}
				else{
					die('|0|No trainer added');
				}
			}
			else{				
				return $this->renderAjax('trainer', [
					'model' => $model,
					'trainingSchedule' => $trainingSchedule,
				]);
			}
		}
    }
	
	public function actionDeleteTrainer($id,$tb_trainer_id)
    {
        if (Yii::$app->request->isAjax){
			$model = \backend\models\TrainingScheduleTrainer::find()
				->where([
					'tb_training_schedule_id' => $id,
					'tb_trainer_id' => $tb_trainer_id,
				])
				->one();
			if ($model!=null) {				
				if($model->delete()) {
					Yii::$app->session->setFlash('success', 'Trainer have deleted');
					$trainingSchedule = \backend\models\TrainingSchedule::findOne($id);
					die('|1|Trainer have added|'.date('Y-m-d',strtotime($trainingSchedule->startTime)).'|'.date('H:i',strtotime($trainingSchedule->finishTime)));
					
				}
				else{
					die('|0|There are some error'.print_r($model->errors));
				}
			}
			else{
				die('|0|There are some error'.print_r($model->errors));
			}
		}
    }
	
	
}
