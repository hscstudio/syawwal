<?php

namespace frontend\modules\eregistrasi\student\controllers;

use Yii;
use frontend\models\Student;
use frontend\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/
		return $this->redirect(['update', 'id' => Yii::$app->user->identity->id]);
		
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       /* $model = new Student();

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
        }*/
		return $this->redirect(['update', 'id' => Yii::$app->user->identity->id]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		//$model->password='';
        $currentFiles=[];
                $currentFiles[0]=$model->photo;
                    
        if ($model->load(Yii::$app->request->post())) {
            $files=[];
								
				$files[0] = \yii\web\UploadedFile::getInstance($model, 'photo');
				$model->photo=isset($currentFiles[0])?$currentFiles[0]:'';
				if(!empty($files[0])){
					$ext = end((explode(".", $files[0]->name)));
					$model->photo = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/student/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/student/'.$model->id.'/';
					}
					@mkdir($path, 0755, true);
					@chmod($path, 0755);
					$paths[0] = $path . $model->photo;
					\hscstudio\heart\helpers\Heart::imageResize($files[0]->tempName, $files[0]->tempName,148,198,0);
					if(isset($currentFiles[0])) @unlink($path . $currentFiles[0]);
				}
			if(!empty($model->password))
			{$model->password_hash = Yii::$app->security->generatePasswordHash($model->password);}
			else {$model->password_hash = $model->password_hash;}
			$model->auth_key = $model->auth_key;
			
			//print_r($model->password.' = '.$model->password_hash);exit();		
            if($model->save()){
				$idx=0;
                foreach($files as $file){
					if(isset($paths[$idx])){
						$file->saveAs($paths[$idx]);
					}
					$idx++;
				}
				\hscstudio\heart\helpers\Heart::imageResize($paths[0], $paths[0],148,198,0);
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
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /*$this->findModel($id)->delete();

        return $this->redirect(['index']);*/
		return $this->redirect(['update', 'id' => Yii::$app->user->identity->id]);
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new Student; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['Student'][$_POST['editableIndex']]);
				$value=$_POST['Student'][$_POST['editableIndex']][$name];
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
            'query' => Student::find(),
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
			$OpenTBS->VarRef['modelName']= "Student";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'ref_religion_id';			
			$data1[]['col2'] = 'ref_graduate_id';			
			$data1[]['col3'] = 'ref_rank_class_id';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $student){
				$data2[] = [
					'col0'=>$student->id,
					'col1'=>$student->ref_religion_id,
					'col2'=>$student->ref_graduate_id,
					'col3'=>$student->ref_rank_class_id,
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
            'query' => Student::find(),
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
								->setCellValue('A1', 'Tabel Student');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $student){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $student->id)
													  ->setCellValue('B'.$idx, $student->ref_religion_id)
													  ->setCellValue('C'.$idx, $student->ref_graduate_id)
													  ->setCellValue('D'.$idx, $student->ref_rank_class_id);
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
								->setCellValue('A1', 'Tabel Student');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $student){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $student->id)
													  ->setCellValue('B'.$idx, $student->ref_religion_id)
													  ->setCellValue('C'.$idx, $student->ref_graduate_id)
													  ->setCellValue('D'.$idx, $student->ref_rank_class_id);
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
									->setCellValue('A1', 'Tabel Student');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $student){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $student->id)
														  ->setCellValue('B'.$idx, $student->ref_religion_id)
														  ->setCellValue('C'.$idx, $student->ref_graduate_id)
														  ->setCellValue('D'.$idx, $student->ref_rank_class_id);
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
            'query' => Student::find(),
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
						$ref_religion_id=  $sheetData[$baseRow]['B'];
						$ref_graduate_id=  $sheetData[$baseRow]['C'];
						$ref_rank_class_id=  $sheetData[$baseRow]['D'];
						$ref_unit_id=  $sheetData[$baseRow]['E'];
						$name=  $sheetData[$baseRow]['F'];
						$nickName=  $sheetData[$baseRow]['G'];
						$frontTitle=  $sheetData[$baseRow]['H'];
						$backTitle=  $sheetData[$baseRow]['I'];
						$nip=  $sheetData[$baseRow]['J'];
						$password_hash=  $sheetData[$baseRow]['K'];
						$auth_key=  $sheetData[$baseRow]['L'];
						$born=  $sheetData[$baseRow]['M'];
						$birthDay=  $sheetData[$baseRow]['N'];
						$gender=  $sheetData[$baseRow]['O'];
						$phone=  $sheetData[$baseRow]['P'];
						$email=  $sheetData[$baseRow]['Q'];
						$address=  $sheetData[$baseRow]['R'];
						$married=  $sheetData[$baseRow]['S'];
						$photo=  $sheetData[$baseRow]['T'];
						$blood=  $sheetData[$baseRow]['U'];
						$position=  $sheetData[$baseRow]['V'];
						$education=  $sheetData[$baseRow]['W'];
						$eselon2=  $sheetData[$baseRow]['X'];
						$eselon3=  $sheetData[$baseRow]['Y'];
						$eselon4=  $sheetData[$baseRow]['Z'];
						$satker=  $sheetData[$baseRow]['AA'];
						$officePhone=  $sheetData[$baseRow]['AB'];
						$officeFax=  $sheetData[$baseRow]['AC'];
						$officeEmail=  $sheetData[$baseRow]['AD'];
						$officeAddress=  $sheetData[$baseRow]['AE'];
						$noSKPangkat=  $sheetData[$baseRow]['AF'];
						$tmtSKPangkat=  $sheetData[$baseRow]['AG'];
						$fileSKPangkat=  $sheetData[$baseRow]['AH'];
						$status=  $sheetData[$baseRow]['AI'];
						//$created=  $sheetData[$baseRow]['AJ'];
						//$createdBy=  $sheetData[$baseRow]['AK'];
						//$modified=  $sheetData[$baseRow]['AL'];
						//$modifiedBy=  $sheetData[$baseRow]['AM'];
						//$deleted=  $sheetData[$baseRow]['AN'];
						//$deletedBy=  $sheetData[$baseRow]['AO'];

						$model2=new Student;
						//$model2->id=  $id;
						$model2->ref_religion_id=  $ref_religion_id;
						$model2->ref_graduate_id=  $ref_graduate_id;
						$model2->ref_rank_class_id=  $ref_rank_class_id;
						$model2->ref_unit_id=  $ref_unit_id;
						$model2->name=  $name;
						$model2->nickName=  $nickName;
						$model2->frontTitle=  $frontTitle;
						$model2->backTitle=  $backTitle;
						$model2->nip=  $nip;
						$model2->password_hash=  $password_hash;
						$model2->auth_key=  $auth_key;
						$model2->born=  $born;
						$model2->birthDay=  $birthDay;
						$model2->gender=  $gender;
						$model2->phone=  $phone;
						$model2->email=  $email;
						$model2->address=  $address;
						$model2->married=  $married;
						$model2->photo=  $photo;
						$model2->blood=  $blood;
						$model2->position=  $position;
						$model2->education=  $education;
						$model2->eselon2=  $eselon2;
						$model2->eselon3=  $eselon3;
						$model2->eselon4=  $eselon4;
						$model2->satker=  $satker;
						$model2->officePhone=  $officePhone;
						$model2->officeFax=  $officeFax;
						$model2->officeEmail=  $officeEmail;
						$model2->officeAddress=  $officeAddress;
						$model2->noSKPangkat=  $noSKPangkat;
						$model2->tmtSKPangkat=  $tmtSKPangkat;
						$model2->fileSKPangkat=  $fileSKPangkat;
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
