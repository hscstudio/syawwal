<?php

namespace backend\modules\pusdiklat\execution\controllers;

use Yii;
use backend\models\TrainingClassStudentAttendance;
use backend\models\TrainingClassStudentAttendanceSearch;
use backend\models\TrainingClassStudent;
use backend\models\TrainingClassStudentSearch;
use backend\models\TrainingSchedule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class TrainingClassStudentAttendanceController extends Controller
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
     * Lists all TrainingClassStudentAttendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainingClassStudentAttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrainingClassStudentAttendance model.
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
     * Creates a new TrainingClassStudentAttendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrainingClassStudentAttendance();

        if ($model->load(Yii::$app->request->post())){
			if($model->save()) {
				 Yii::$app->session->setFlash('success', 'Data saved');
			}
			else{
				 Yii::$app->session->setFlash('error', 'Unable create there are some error');
			}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }







    public function actionUpdate($for, $idSubjects, $tb_training_schedule_id)
    {
    	if ($for == 'student') {

    		// Mbelah id schedule, kalau jamak
    		$idSchedule = explode('_', $tb_training_schedule_id);
    		// dah

    		// Ngambil schedule
    		$modelTrainingSchedule = [];
    		for ($i = 0; $i < count($idSchedule); $i++) {
	    		$modelTrainingSchedule[$i] = TrainingSchedule::find()
	    			->where(['id' => $idSchedule[$i]])
	    			->one();
    		}
    		//dah

    		// Cek dulu apakah class_id pada schedule itu sama, klo beda ada yg salah sm request, lempar
    		// Jadi, class_id yg sama pada setiap schedule artinya kita sedang mengedit absensi untuk session yang sama
    		$different = false;
    		$referenceClass = '';
    		
    		for ($i = 0; $i < count($modelTrainingSchedule); $i++) {
    			
    			if ($referenceClass == '') {
    				$referenceClass = $modelTrainingSchedule[$i]['tb_training_class_id'];
    			}

    			if ($modelTrainingSchedule[$i]['tb_training_class_id'] != $referenceClass) {
    				$different = true;
    			}

    		}

    		if ($different) {
    			Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Filling attendance should for one class only!');
    			return $this->redirect(['training/index']);
    		}
    		// dah

			// Input tabel attendance dg schedule_id dan student_id
			$readyInjectStudent2Attendance = TrainingClassStudent::find()->where(['tb_training_class_id' => $referenceClass])->all();

			for ($i = 0; $i < count($idSchedule); $i++) {						// Ngeloop dulu, siapa tau schedule_id nya lebih dari 1
				foreach ($readyInjectStudent2Attendance as $row) {						// Dari sini, mulai nginject
					$injector = TrainingClassStudentAttendance::find()
						->where([
							'tb_training_schedule_id' => $idSchedule[$i],
							'tb_training_class_student_id' => $row->id
						])
						->one();

					// Cek uda ada record ga?
					if ($injector === null) {
						$injector = new TrainingClassStudentAttendance;
						$injector->tb_training_schedule_id = $idSchedule[$i];
						$injector->tb_training_class_student_id = $row->id;
						$injector->hours = 0;
						$injector->status = 1;
						$injector->save();
					}
				}
			}
			// dah

    		// Bikin data provider student dari class schedule
    		$searchModel = new TrainingClassStudentSearch(); 

			$queryParams['TrainingClassStudentSearch'] = [
				'tb_training_class_id' => $referenceClass
			];

			$queryParams = ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);

			$dataProvider = $searchModel->search($queryParams);
			// dah
    		
            return $this->render('update', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'tb_training_schedule_id' => $tb_training_schedule_id,
                'tb_training_class_id' => $referenceClass,
                'idSchedule' => $idSchedule
            ]);

    	}

    	else if ($for == 'trainer') {

    		// Mbelah id schedule, kalau jamak
    		$idSchedule = explode('_', $tb_training_schedule_id);
    		// dah

    		// Ngambil schedule
    		$modelTrainingSchedule = [];
    		for ($i = 0; $i < count($idSchedule); $i++) {
	    		$modelTrainingSchedule[$i] = TrainingSchedule::find()
	    			->where(['id' => $idSchedule[$i]])
	    			->one();
    		}
    		//dah

    		// Cek dulu apakah class_id pada schedule itu sama, klo beda ada yg salah sm request, lempar
    		// Jadi, class_id yg sama pada setiap schedule artinya kita sedang mengedit absensi untuk session yang sama
    		$different = false;
    		$referenceClass = '';
    		
    		for ($i = 0; $i < count($modelTrainingSchedule); $i++) {
    			
    			if ($referenceClass == '') {
    				$referenceClass = $modelTrainingSchedule[$i]['tb_training_class_id'];
    			}

    			if ($modelTrainingSchedule[$i]['tb_training_class_id'] != $referenceClass) {
    				$different = true;
    			}

    		}

    		if ($different) {
    			Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Filling attendance should for one class only!');
    			return $this->redirect(['training/index']);
    		}
    		// dah

			// Input tabel attendance dg schedule_id dan student_id
			$readyInjectStudent2Attendance = TrainingClassStudent::find()->where(['tb_training_class_id' => $referenceClass])->all();

			for ($i = 0; $i < count($idSchedule); $i++) {						// Ngeloop dulu, siapa tau schedule_id nya lebih dari 1
				foreach ($readyInjectStudent2Attendance as $row) {						// Dari sini, mulai nginject
					$injector = TrainingClassStudentAttendance::find()
						->where([
							'tb_training_schedule_id' => $idSchedule[$i],
							'tb_training_class_student_id' => $row->id
						])
						->one();

					// Cek uda ada record ga?
					if ($injector === null) {
						$injector = new TrainingClassStudentAttendance;
						$injector->tb_training_schedule_id = $idSchedule[$i];
						$injector->tb_training_class_student_id = $row->id;
						$injector->hours = 0;
						$injector->status = 1;
						$injector->save();
					}
				}
			}
			// dah

    		// Bikin data provider student dari class schedule
    		$searchModel = new TrainingClassStudentSearch(); 

			$queryParams['TrainingClassStudentSearch'] = [
				'tb_training_class_id' => $referenceClass
			];

			$queryParams = ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);

			$dataProvider = $searchModel->search($queryParams);
			// dah
    		
            return $this->render('update', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'tb_training_schedule_id' => $tb_training_schedule_id,
                'tb_training_class_id' => $referenceClass,
                'idSchedule' => $idSchedule
            ]);

    	}
    	else {
    		// Request for ga dikenali, lempar
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Request is not recognized while attempting attendance!');
			return $this->redirect(['training/index']);
    	}
    }

    /**
     * Deletes an existing TrainingClassStudentAttendance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrainingClassStudentAttendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainingClassStudentAttendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainingClassStudentAttendance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {

		// Cuma ajax yg boleh manggil fungsi ni
		if (Yii::$app->request->isAjax == false) {
			Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Forbidden!');
			return $this->redirect(['training/index']);
		}
		// dah

		$modelTrainingClassStudentAttendance = TrainingClassStudentAttendance::find()
			->where([
				'tb_training_class_student_id' => Yii::$app->request->post('tb_training_class_student_id'),
				'tb_training_schedule_id' => Yii::$app->request->post('tb_training_schedule_id'),
			])
			->one();

		$modelTrainingClassStudentAttendance->hours = Yii::$app->request->post('hours');

		$modelTrainingClassStudentAttendance->save();

		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> Change saved!');

		echo Json::encode($modelTrainingClassStudentAttendance->hours);

	}

	public function actionOpenTbs($filetype='docx'){
		$dataProvider = new ActiveDataProvider([
            'query' => TrainingClassStudentAttendance::find(),
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
			$OpenTBS->VarRef['modelName']= "TrainingClassStudentAttendance";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'tb_training_schedule_id';			
			$data1[]['col2'] = 'tb_training_class_student_id';			
			$data1[]['col3'] = 'hours';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $trainingclassstudentattendance){
				$data2[] = [
					'col0'=>$trainingclassstudentattendance->id,
					'col1'=>$trainingclassstudentattendance->tb_training_schedule_id,
					'col2'=>$trainingclassstudentattendance->tb_training_class_student_id,
					'col3'=>$trainingclassstudentattendance->hours,
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
            'query' => TrainingClassStudentAttendance::find(),
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
								->setCellValue('A1', 'Tabel TrainingClassStudentAttendance');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingclassstudentattendance){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentattendance->id)
													  ->setCellValue('B'.$idx, $trainingclassstudentattendance->tb_training_schedule_id)
													  ->setCellValue('C'.$idx, $trainingclassstudentattendance->tb_training_class_student_id)
													  ->setCellValue('D'.$idx, $trainingclassstudentattendance->hours);
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
								->setCellValue('A1', 'Tabel TrainingClassStudentAttendance');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $trainingclassstudentattendance){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentattendance->id)
													  ->setCellValue('B'.$idx, $trainingclassstudentattendance->tb_training_schedule_id)
													  ->setCellValue('C'.$idx, $trainingclassstudentattendance->tb_training_class_student_id)
													  ->setCellValue('D'.$idx, $trainingclassstudentattendance->hours);
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
									->setCellValue('A1', 'Tabel TrainingClassStudentAttendance');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $trainingclassstudentattendance){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentattendance->id)
														  ->setCellValue('B'.$idx, $trainingclassstudentattendance->tb_training_schedule_id)
														  ->setCellValue('C'.$idx, $trainingclassstudentattendance->tb_training_class_student_id)
														  ->setCellValue('D'.$idx, $trainingclassstudentattendance->hours);
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
            'query' => TrainingClassStudentAttendance::find(),
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
						$tb_training_schedule_id=  $sheetData[$baseRow]['B'];
						$tb_training_class_student_id=  $sheetData[$baseRow]['C'];
						$hours=  $sheetData[$baseRow]['D'];
						$reason=  $sheetData[$baseRow]['E'];
						$status=  $sheetData[$baseRow]['F'];
						//$created=  $sheetData[$baseRow]['G'];
						//$createdBy=  $sheetData[$baseRow]['H'];
						//$modified=  $sheetData[$baseRow]['I'];
						//$modifiedBy=  $sheetData[$baseRow]['J'];
						//$deleted=  $sheetData[$baseRow]['K'];
						//$deletedBy=  $sheetData[$baseRow]['L'];

						$model2=new TrainingClassStudentAttendance;
						//$model2->id=  $id;
						$model2->tb_training_schedule_id=  $tb_training_schedule_id;
						$model2->tb_training_class_student_id=  $tb_training_class_student_id;
						$model2->hours=  $hours;
						$model2->reason=  $reason;
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
