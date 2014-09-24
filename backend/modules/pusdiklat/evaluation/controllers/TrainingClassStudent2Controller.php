<?php

namespace backend\modules\pusdiklat\evaluation\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\TrainingClassStudent;
use backend\models\TrainingClassStudentSearch;
use backend\models\TrainingClassStudentCertificate; 
use backend\models\TrainingClassStudentCertificateSearch; 
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainingClassStudentController implements the CRUD actions for TrainingClassStudent model.
 */
class TrainingClassStudent2Controller extends Controller
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
     * Lists all TrainingClassStudent models.
     * @return mixed
     */
    public function actionIndex($tb_training_id,$tb_training_class_id=0)
    {
		$trainingClass = \backend\models\TrainingClass::find()
			->where(['tb_training_id'=>$tb_training_id])
			->orderBy('id ASC')
			->all();
		$listTrainingClass = [];	
		foreach($trainingClass as $ts){
			if($tb_training_class_id==0){
				$tb_training_class_id=$ts->id;
			}
			$listTrainingClass[$ts->id]=$ts->class;
		}
		
		if($tb_training_class_id==0){
			Yii::$app->session->setFlash('warning', 'Anda harus membuat kelas terlebih dulu!');
			return $this->redirect([
				'./training-class/index', 'tb_training_id' => $tb_training_id
			]);
		}
		
        $searchModel = new TrainingClassStudentSearch();
		$queryParams = Yii::$app->request->getQueryParams();
		$queryParams['TrainingClassStudentSearch']=[
					'tb_training_class_id' => $tb_training_class_id,
				];
        $queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
		//$dataProvider->getSort()->defaultOrder = ['start'=>SORT_ASC,'finish'=>SORT_ASC];
		
		$training = \backend\models\Training::findOne($tb_training_id);
		
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'training'=>$training,
			'listTrainingClass'=>$listTrainingClass,
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
        ]);
    }

	/**
     * Lists all TrainingClassStudent models.
     * @return mixed
     */
    public function actionCertificate($tb_training_id,$tb_training_class_id=0)
    {
		$trainingClass = \backend\models\TrainingClass::find()
			->where(['tb_training_id'=>$tb_training_id])
			->orderBy('id ASC')
			->all();
		$listTrainingClass = [];	
		foreach($trainingClass as $ts){
			if($tb_training_class_id==0){
				$tb_training_class_id=$ts->id;
			}
			$listTrainingClass[$ts->id]=$ts->class;
		}
		
		if($tb_training_class_id==0){
			Yii::$app->session->setFlash('warning', 'Anda harus membuat kelas terlebih dulu!');
			return $this->redirect([
				'./training-class/index', 'tb_training_id' => $tb_training_id
			]);
		}
		
        $searchModel = new TrainingClassStudentSearch();
		$queryParams = Yii::$app->request->getQueryParams();
		$queryParams['TrainingClassStudentSearch']=[
					'tb_training_class_id' => $tb_training_class_id,
				];
        $queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
		//$dataProvider->getSort()->defaultOrder = ['start'=>SORT_ASC,'finish'=>SORT_ASC];
		
		$training = \backend\models\Training::findOne($tb_training_id);
		
		
        return $this->render('certificate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'training'=>$training,
			'listTrainingClass'=>$listTrainingClass,
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
        ]);
    }
	
	     /** 
     * Creates a new TrainingClassStudentCertificate model. 
     * If creation is successful, the browser will be redirected to the 'view' page. 
     * @return mixed 
     */ 
    public function actionCreate2($id,$tb_training_id,$tb_training_class_id) 
    { 
        $model = new TrainingClassStudentCertificate(); 

        if ($model->load(Yii::$app->request->post())){ 
			// 
			$trainingClassStudent = \backend\models\TrainingClassStudent::findOne($id);
			$student = \backend\models\Student::findOne($trainingClassStudent->trainingStudent->tb_student_id);
			$model->position=$student->position;
			$model->positionDesc=$student->positionDesc;
			$model->education=$student->education;
			$model->eselon2=$student->eselon2;
			$model->eselon3=$student->eselon3;
			$model->eselon4=$student->eselon4;
			$model->satker=$student->satker;			
			//
			$model->tb_training_class_student_id=$id;
            if($model->save()) { 
                Yii::$app->session->setFlash('success', 'Data saved'); 
            } 
            else{ 
				//die(print_r($model->errors));
                Yii::$app->session->setFlash('error', 'Unable create there are some error'); 
            } 
            return $this->redirect([
				'view2', 
				'id' => $model->tb_training_class_student_id,
				'tb_training_id'=>$tb_training_id,
				'tb_training_class_id'=>$tb_training_class_id,
			]); 
        } else { 
            return $this->render('create2', [ 
                'model' => $model, 
				'tb_training_id'=>$tb_training_id,
				'tb_training_class_id'=>$tb_training_class_id,
            ]); 
        } 
    } 
	
	/** 
     * Updates an existing TrainingClassStudentCertificate model. 
     * If update is successful, the browser will be redirected to the 'view' page. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionUpdate2($id,$tb_training_id,$tb_training_class_id) 
    { 
        $model = $this->findModel2($id);          
        if ($model->load(Yii::$app->request->post())) {  
			// 
			$trainingClassStudent = \backend\models\TrainingClassStudent::findOne($id);
			$student = \backend\models\Student::findOne($trainingClassStudent->trainingStudent->tb_student_id);
			$model->position=$student->position;
			$model->positionDesc=$student->positionDesc;
			$model->education=$student->education;
			$model->eselon2=$student->eselon2;
			$model->eselon3=$student->eselon3;
			$model->eselon4=$student->eselon4;
			$model->satker=$student->satker;	
            if($model->save()){ 
                Yii::$app->session->setFlash('success', 'Data saved'); 
                return $this->redirect([
					'view2', 
					'id' => $model->tb_training_class_student_id,
					'tb_training_id'=>$tb_training_id,
					'tb_training_class_id'=>$tb_training_class_id,
				]); 
            } else { 
                // error in saving model 
                Yii::$app->session->setFlash('error', 'There are some errors'); 
            }             
        } 
        else{ 
            //return $this->render(['update', 'id' => $model->tb_training_class_student_id]); 
            return $this->render('update2', [ 
                'model' => $model, 
				'tb_training_id'=>$tb_training_id,
				'tb_training_class_id'=>$tb_training_class_id,
            ]); 
        } 
    } 
	
	/** 
     * Displays a single TrainingClassStudentCertificate model. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionView2($id,$tb_training_id,$tb_training_class_id) 
    { 
        return $this->render('view2', [ 
            'model' => $this->findModel2($id), 
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
        ]); 
    } 
	
	/** 
     * Deletes an existing TrainingClassStudentCertificate model. 
     * If deletion is successful, the browser will be redirected to the 'index' page. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionDelete2($id,$tb_training_id,$tb_training_class_id) 
    { 
        $this->findModel2($id)->delete(); 

        return $this->redirect([
			'certificate',
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
		]); 
    } 
	
	/** 
     * Finds the TrainingClassStudentCertificate model based on its primary key value. 
     * If the model is not found, a 404 HTTP exception will be thrown. 
     * @param integer $id
     * @return TrainingClassStudentCertificate the loaded model 
     * @throws NotFoundHttpException if the model cannot be found 
     */ 
    protected function findModel2($id) 
    { 
        if (($model = TrainingClassStudentCertificate::findOne($id)) !== null) { 
            return $model; 
        } else { 
            throw new NotFoundHttpException('The requested page does not exist.'); 
        } 
    } 
	
	 /** 
     * Displays a single TrainingClassStudentCertificate model. 
     * @param integer $id
     * @return mixed 
     */ 
   public function actionView($id,$tb_training_id,$tb_training_class_id) 
    { 
        $trainingClassStudent = $this->findModel($id);  
		$model = \backend\models\Student::findOne($trainingClassStudent->trainingStudent->tb_student_id);
		return $this->render('view', [ 
            'model' => $model, 
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
        ]); 
    } 

     /** 
     * Updates an existing TrainingClassStudentCertificate model. 
     * If update is successful, the browser will be redirected to the 'view' page. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionUpdate($id,$tb_training_id,$tb_training_class_id) 
    { 
        $trainingClassStudent = $this->findModel($id);  
		$model = \backend\models\Student::findOne($trainingClassStudent->trainingStudent->tb_student_id);
		
		$currentFiles=[];
        $currentFiles[0]=$model->photo;
		
        if ($model->load(Yii::$app->request->post())) { 
			$files[0] = \yii\web\UploadedFile::getInstance($model, 'photo');
			
			$model->photo=isset($currentFiles[0])?$currentFiles[0]:'';
			if(!empty($files[0])){
				$ext = end((explode(".", $files[0]->name)));
				$filenames[0] = uniqid() . '.' . $ext;				
				$model->photo = $filenames[0];
				$paths[0] = '';
				if(isset(Yii::$app->params['uploadPath'])){
					$paths[0] = Yii::$app->params['uploadPath'].'/student/'.$model->id.'/';
				}
				else{
					$paths[0] = Yii::getAlias('@common').'/../files/student/'.$model->id.'/';
				}
				@mkdir($paths[0], 0755, true);
				@chmod($paths[0], 0755);
				if(isset($currentFiles[0])){
					@unlink($paths[0] . $currentFiles[0]);
					@unlink($paths[0] . 'thumb_'. $currentFiles[0]);
				}
			}
				
            if($model->save()){ 
				if(isset($filenames[0])){
					$files[0]->saveAs($paths[0].$filenames[0]);
					\hscstudio\heart\helpers\Heart::imageResize($paths[0].$filenames[0], $paths[0]. 'thumb_'. $filenames[0],148,198,0);
				}
                Yii::$app->session->setFlash('success', 'Data saved');                 
            } else { 
                // error in saving model 
                Yii::$app->session->setFlash('error', 'There are some errors'); 
            } 
			
			return $this->redirect([
				'view', 
				'id' => $trainingClassStudent->id,
				'tb_training_id'=>$tb_training_id,
				'tb_training_class_id'=>$tb_training_class_id,
			]); 
        } 
        else{ 
            //return $this->render(['update', 'id' => $model->tb_training_class_student_id]); 
            return $this->render('update', [ 
                'model' => $model, 
				'trainingClassStudent' => $trainingClassStudent,
				'tb_training_id'=>$tb_training_id,
				'tb_training_class_id'=>$tb_training_class_id,
            ]); 
        } 
    } 

    /** 
     * Finds the TrainingClassStudentCertificate model based on its primary key value. 
     * If the model is not found, a 404 HTTP exception will be thrown. 
     * @param integer $id
     * @return TrainingClassStudentCertificate the loaded model 
     * @throws NotFoundHttpException if the model cannot be found 
     */ 
    protected function findModel($id) 
    { 
        if (($model = TrainingClassStudent::findOne($id)) !== null) { 
            return $model; 
        } else { 
            throw new NotFoundHttpException('The requested page does not exist.'); 
        } 
    } 
     
    public function actionEditable() { 
        $model = new TrainingClassStudentCertificate; // your model can be loaded here 
        // Check if there is an Editable ajax request 
        if (isset($_POST['hasEditable'])) { 
            // read your posted model attributes 
            if ($model->load($_POST)) { 
                // read or convert your posted information 
                $model2 = $this->findModel($_POST['editableKey']); 
                $name=key($_POST['TrainingClassStudentCertificate'][$_POST['editableIndex']]); 
                $value=$_POST['TrainingClassStudentCertificate'][$_POST['editableIndex']][$name]; 
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
            'query' => TrainingClassStudentCertificate::find(), 
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
            $OpenTBS->VarRef['modelName']= "TrainingClassStudentCertificate"; 
            $data1[]['col0'] = 'tb_training_class_student_id';             
            $data1[]['col1'] = 'ref_unit_id';             
            $data1[]['col2'] = 'ref_graduate_id';             
            $data1[]['col3'] = 'ref_rank_class_id';             
     
            $OpenTBS->MergeBlock('a', $data1);             
            $data2 = []; 
            foreach($dataProvider->getModels() as $trainingclassstudentcertificate){ 
                $data2[] = [ 
                    'col0'=>$trainingclassstudentcertificate->tb_training_class_student_id, 
                    'col1'=>$trainingclassstudentcertificate->ref_unit_id, 
                    'col2'=>$trainingclassstudentcertificate->ref_graduate_id, 
                    'col3'=>$trainingclassstudentcertificate->ref_rank_class_id, 
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
            'query' => TrainingClassStudentCertificate::find(), 
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
                                ->setCellValue('A1', 'Tabel TrainingClassStudentCertificate'); 
                    $idx=2; // line 2 
                    foreach($dataProvider->getModels() as $trainingclassstudentcertificate){ 
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentcertificate->tb_training_class_student_id) 
                                                      ->setCellValue('B'.$idx, $trainingclassstudentcertificate->ref_unit_id) 
                                                      ->setCellValue('C'.$idx, $trainingclassstudentcertificate->ref_graduate_id) 
                                                      ->setCellValue('D'.$idx, $trainingclassstudentcertificate->ref_rank_class_id); 
                        $idx++; 
                    }         
                     
                    // Redirect output to a client?s web browser 
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
                                ->setCellValue('A1', 'Tabel TrainingClassStudentCertificate'); 
                    $idx=2; // line 2 
                    foreach($dataProvider->getModels() as $trainingclassstudentcertificate){ 
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentcertificate->tb_training_class_student_id) 
                                                      ->setCellValue('B'.$idx, $trainingclassstudentcertificate->ref_unit_id) 
                                                      ->setCellValue('C'.$idx, $trainingclassstudentcertificate->ref_graduate_id) 
                                                      ->setCellValue('D'.$idx, $trainingclassstudentcertificate->ref_rank_class_id); 
                        $idx++; 
                    }         
                                     
                    // Redirect output to a client?s web browser (Excel2007) 
                    if($filetype=='xlsx') 
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
                    // Redirect output to a client?s web browser (Excel5) 
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
                                    ->setCellValue('A1', 'Tabel TrainingClassStudentCertificate'); 
                        $idx=2; // line 2 
                        foreach($dataProvider->getModels() as $trainingclassstudentcertificate){ 
                            $objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $trainingclassstudentcertificate->tb_training_class_student_id) 
                                                          ->setCellValue('B'.$idx, $trainingclassstudentcertificate->ref_unit_id) 
                                                          ->setCellValue('C'.$idx, $trainingclassstudentcertificate->ref_graduate_id) 
                                                          ->setCellValue('D'.$idx, $trainingclassstudentcertificate->ref_rank_class_id); 
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
                            // Redirect output to a client?s web browser (PDF) 
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
     
    public function actionPrintFrontendCertificate($tb_training_id,$tb_training_class_id,$filetype='docx'){ 
         
        try { 
            $templates=[ 
                'docx'=>'ms-word.docx', 
                'odt'=>'open-document.odt', 
                'xlsx'=>'ms-excel.xlsx' 
            ]; 
            // Initalize the TBS instance 
            $OpenTBS = new \hscstudio\heart\extensions\OpenTBS; // new instance of TBS 
            // Change with Your template kaka 
            //$template = Yii::getAlias('@common').'/extensions/opentbs-template/'.$templates[$filetype]; 
			$path = '';
			if(isset(Yii::$app->params['uploadPath'])){
				$path = Yii::$app->params['uploadPath'].DIRECTORY_SEPARATOR;
			}
			else{
				$path = Yii::getAlias('@common').DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR;
			}
			$template_path = $path . 'templates'.DIRECTORY_SEPARATOR.'certificate'.DIRECTORY_SEPARATOR;
			$template = $template_path . 'frontend.certificate.docx';
			$type_certificate = "SERTIFIKAT";
			$type_certificate_id = Yii::$app->request->post('type_certificate');
			if($type_certificate_id == 2){
				$template = $template_path . 'frontend.certificate.seminar.docx';
			}
			else if($type_certificate_id == 1){
				$type_certificate = "Surat Tanda Tamat Pendidikan dan Pelatihan";
			}
            $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
            //$OpenTBS->VarRef['modelName']= "TrainingClassStudentCertificate";            
			
            $data = []; 
			$idx = 0;
			$number="";
			$trainingClassStudentCertificates = \backend\models\TrainingClassStudentCertificate::find()
				->where([
					'tb_training_class_student_id' => TrainingClassStudent::find()
						->where([
							'tb_training_id'=>$tb_training_id,
							'tb_training_class_id'=>$tb_training_class_id,
							'status'=>1,
						])
						->column(),
					'status'=>1,
				])
				->all();
			
			$name_signer = '';
			$nip_signer = '';
			$position_signer = '';
			$city_signer = '';
			
            foreach($trainingClassStudentCertificates as $trainingClassStudentCertificate){ 
				if($idx==0){
					$numbers = explode('-',$trainingClassStudentCertificate->trainingClassStudent->training->number);
					// 2014-03-00-2.2.1.0.2 to /2.3.1.2.138/07/00/2014
					$number = '';
					if(isset($numbers[3]) and strlen($numbers[3])>3){
						$number .= '/'.$numbers[3];
					}
					if(isset($numbers[1]) and strlen($numbers[1])==2){
						$number .= '/'.$numbers[1];
					}
					if(isset($numbers[2]) and strlen($numbers[2])==2){
						$number .= '/'.$numbers[2];
					}
					if(isset($numbers[0]) and strlen($numbers[0])==4){
						$number .= '/'.$numbers[0];
					}
					
					$program = \backend\models\ProgramHistory::find()
					->where([
						'tb_program_id'=>$trainingClassStudentCertificate->trainingClassStudent->training->tb_program_id,
						'revision'=>$trainingClassStudentCertificate->trainingClassStudent->training->tb_program_revision,
					])
					->one();
					
					$type_graduate = "TELAH MENGIKUTI";
					if($program->test==1){
						$type_graduate = "LULUS";
					}
					
					if($program->hours==(int)$program->hours){
						$hours_program = (int)$program->hours;
					}
					else{
						$hours_program = str_replace('.',',',$program->hours);
					}
					
					$name_executor = $trainingClassStudentCertificate->trainingClassStudent->training->satker->name;
					$name_training = Yii::$app->request->post('name_training');
					$location_training = Yii::$app->request->post('location_training');
					
					$signer = (int)Yii::$app->request->post('signer');
					$employee = \backend\models\Employee::findOne($signer);
					if(!null == $employee){
						$name_signer = $employee->name;
						$nip_signer = $employee->nip;
						$position_signer = $employee->positionDesc;
						$city_signer = Yii::$app->request->post('city_signer');
					}
					$idx++;
				}
				
				$student = $trainingClassStudentCertificate->trainingClassStudent->trainingStudent->student;
				$instansi = $student->unit->name;
				if($student->satker>1){
					$eselon = 'eselon'.$student->satker;
					$instansi =$student->$eselon;
				}
				
				if (file_exists($path.'student/'.$student->id.'/'.$student->photo) and strlen($student->photo)>3)
					$photo = $path.'student/'.$student->id.'/thumb_'.$student->photo;						
				
                $data[] = [
					// CERTIFICATE DATA
					'type_certificate'=>$type_certificate,
					'type_graduate'=>$type_graduate,
					'seri'=>$trainingClassStudentCertificate->seri, 
                    'number'=>$trainingClassStudentCertificate->number.$number, 
					'year_training'=>date('Y',strtotime($trainingClassStudentCertificate->trainingClassStudent->training->start)), 
					'date_training'=>\hscstudio\heart\helpers\Heart::twodate(
						date('Y-m-d',strtotime($trainingClassStudentCertificate->trainingClassStudent->training->start)),
						date('Y-m-d',strtotime($trainingClassStudentCertificate->trainingClassStudent->training->finish)),
						0, // month type
						0, // year type
						' ', // delimiter
						' sampai dengan '
					),
					'hours_training'=>$hours_program, 
					'name_executor'=>$name_executor,
					'name_training'=>$name_training,
					'location_training'=>$location_training,
					// STUDENT DATA                    
                    'name_student'=>$student->name, 
                    'nip_student'=>$student->nip,					
					'born_student'=>$student->born,
					'birthDay_student'=>$student->birthDay,
					'rankClass_student'=>$student->rankClass->name,
					'position_student'=>$student->positionDesc,
					'satker_student'=>$instansi,
					'photo_student'=>$photo, 
					//SIGNER DATA
					'city_signer'=>$city_signer,
					'date_signer'=>\hscstudio\heart\helpers\Heart::twodate($trainingClassStudentCertificate->date),
					'position_signer'=>$position_signer,
					'name_signer'=>$name_signer,
					'nip_signer'=>$nip_signer,
                ]; 
            } 
            $OpenTBS->MergeBlock('data', $data); 
            // Output the result as a file on the server. You can change output file 
            $OpenTBS->Show(OPENTBS_DOWNLOAD, 'certificate.'.$filetype); // Also merges all [onshow] automatic fields.            
            exit; 
		} catch (\yii\base\ErrorException $e) { 
             Yii::$app->session->setFlash('error', 'Unable export there are some error'); 
        }     
         
		return $this->redirect([
			'certificate', 
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
		]);
    }   

    public function actionPrintBackendCertificate($tb_training_id,$tb_training_class_id,$filetype='docx'){ 
       // try { 
            $templates=[ 
                'docx'=>'ms-word.docx', 
                'odt'=>'open-document.odt', 
                'xlsx'=>'ms-excel.xlsx' 
            ]; 
            // Initalize the TBS instance 
            $OpenTBS = new \hscstudio\heart\extensions\OpenTBS; // new instance of TBS 
            // Change with Your template kaka 
            //$template = Yii::getAlias('@common').'/extensions/opentbs-template/'.$templates[$filetype]; 
			$path = '';
			if(isset(Yii::$app->params['uploadPath'])){
				$path = Yii::$app->params['uploadPath'].DIRECTORY_SEPARATOR;
			}
			else{
				$path = Yii::getAlias('@common').DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR;
			}
			$template_path = $path . 'templates'.DIRECTORY_SEPARATOR.'certificate'.DIRECTORY_SEPARATOR;
			$template = $template_path . 'backend.certificate.docx';
			
            $OpenTBS->LoadTemplate($template); // Also merge some [onload] automatic fields (depends of the type of document).
            //$OpenTBS->VarRef['modelName']= "TrainingClassStudentCertificate";            
			
            $data = []; 
			$training = \backend\models\Training::findOne($tb_training_id);
			$programSubjectHistories = \backend\models\ProgramSubjectHistory::find()
				->where([
					'tb_program_id' => $training->tb_program_id,
					'revision' => $training->tb_program_revision,
					'status'=>1,
				])
				->all();
				
            foreach($programSubjectHistories as $programSubjectHistory){ 										
                $data[] = [
					'name_subject'=>$programSubjectHistory->name,					
                ]; 
            }
			$OpenTBS->MergeBlock('data', $data); 
			
			$signer = (int)Yii::$app->request->post('signer');
			$employee = \backend\models\Employee::findOne($signer);
			if(!null == $employee){
				$name_signer = $employee->name;
				$nip_signer = $employee->nip;
				$position_signer = $employee->positionDesc;
				$city_signer = Yii::$app->request->post('city_signer');
				$date_signer = Yii::$app->request->post('date_signer');
				$data2[] = [
					'city_signer'=>$city_signer,
					'date_signer'=>\hscstudio\heart\helpers\Heart::twodate($date_signer),
					'position_signer'=>$position_signer,
					'name_signer'=>$name_signer,
					'nip_signer'=>$nip_signer,
				];
				$OpenTBS->MergeBlock('data2', $data2); 
			}
			
            // Output the result as a file on the server. You can change output file 
            $OpenTBS->Show(OPENTBS_DOWNLOAD, 'certificate_back.'.$filetype); // Also merges all [onshow] automatic fields.            
            exit; 
		//} catch (\yii\base\ErrorException $e) { 
             Yii::$app->session->setFlash('error', 'Unable export there are some error'); 
       // }     
         
		/*return $this->redirect([
			'certificate', 
			'tb_training_id'=>$tb_training_id,
			'tb_training_class_id'=>$tb_training_class_id,
		]);*/
    }	
}
