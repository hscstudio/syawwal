<?php

namespace backend\modules\bdk\execution\controllers;

use Yii;
use backend\models\Training;
use backend\models\TrainingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Satker;
use yii\helpers\ArrayHelper;
use backend\models\Program;
use backend\models\ProgramHistory;
use backend\models\TrainingHistory;
use yii\helpers\Json;

/**
 * TrainingController implements the CRUD actions for Training model.
 */
class TrainingController extends Controller
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
     * Lists all Training models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Training model.
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
     * Creates a new Training model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Training();

        // Bikin data map dari model satker
        $dataEs2 = ArrayHelper::map(Satker::find()
        	->select(['id','name'])
        	->where(['eselon' => 0])
        	->orWhere(['eselon' => 2])
        	->asArray()
        	->all(),
        'id', 'name');

        if ($model->load(Yii::$app->request->post())) {

        	// Ambil revision terakhir dari program history
        	$model->revision = ProgramHistory::getRevision($model->tb_program_id);

        	// Ngeset approved status ke 0
        	$model->approvedStatus = null;

			if($model->save()) {
				Yii::$app->session->setFlash('success', 'Data saved');
				// Nyimpen history training
				$model2 = new TrainingHistory();
				$model2->attributes = array_merge(
				  $model->attributes,[
					'tb_training_id'=> $model->id,
				  ]
				);				
				$model2->save();
			}
			else
			{
				 Yii::$app->session->setFlash('error', 'Unable create there are some error');
			}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataEs2' => $dataEs2
            ]);
        }
    }




    /*
    Ngasih data program berdasarkan eselon yang masuk
    */
    public function actionProgram()
    {
		if ( Yii::$app->request->post('eselon') == 0)
		{
	    	$programEs = Program::find()->all();
		}
		else
		{
	    	$programEs = Program::find()
	        	->select(['id','name'])
	        	->where(['ref_satker_id' => Yii::$app->request->post('eselon'), 'status' => 1 ])
	        	->all();
		}

		echo '<option selected>-- No program selected --</option>';
        foreach($programEs as $p) 
        {
            echo "<option value='".$p->id."'>".$p->name."</option>";
        }
    }

    



    /* 
    Ngasi list revisi program
	*/
	public function actionRev() {
	    $out = [];
	    if (isset($_POST['depdrop_parents'])) {
	        $parents = $_POST['depdrop_parents'];
	        if ($parents != null) {
	        	// Ngambil id program
	            $idProg = $parents[0];

	            // nyari semua revisi berdasarkan id program td
	            $asd = ProgramHistory::find()
		        	->select(['revision', 'name'])
		        	->where(['tb_program_id' => $idProg])
		        	->asArray()
		        	->orderBy(['revision' => SORT_DESC])
		        	->all();

		        foreach ($asd as $key) {
		        	$out[] = ['id' => $key['revision'], 'name' => 'Rev '.$key['revision'].' -> '.$key['name']];
		        }

	            echo Json::encode(['output'=>$out, 'selected'=>'']);
	            return;
	        }
	    }

	    echo Json::encode(['output'=>'', 'selected'=>'']);

	}

    /**
     * Updates an existing Training model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currentFiles=[];

        // Bikin data map dari model satker
        $dataEs2 = ArrayHelper::map(Satker::find()
        	->select(['id','name'])
        	->where(['eselon' => 0])
        	->orWhere(['eselon' => 2])
        	->asArray()
        	->all(),
        'id', 'name');
        
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

				// Klo neken tombol save as revision
				if(Yii::$app->request->post('create_revision') !== null )
				{
					// Nyimpen revisi
					$model2 = new TrainingHistory();
					$model2->attributes = array_merge(
					  $model->attributes,[
						'tb_training_id' => $model->id,
						'revision' => $model->revision + 1,
					  ]
					);
					$model2->save();

					// Ngapdate field revision menjadi yang terbaru
					$model->revision += 1;
					$model->save();
					
					Yii::$app->session->setFlash('success', 'Save as revision');	
				}
				else
				{
					// Ngupdate history aja
					$model2 = TrainingHistory::find()
						->where(['tb_training_id' => $model->id])
						->orderBy(['revision'=>'DESC'])
						->one();
					$model2->attributes = array_merge($model->attributes);
					$model2->save();
				}
				// done

                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                // error in saving model
				Yii::$app->session->setFlash('error', 'There are some errors');
            }            
        }
		else
		{
			return $this->render('update', [
                'model' => $model,
                'dataEs2' => $dataEs2
            ]);
		}
    }

    /**
     * Deletes an existing Training model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // Ngapus historynya juga, all
        TrainingHistory::deleteAll('tb_training_id = :tb_training_id', [':tb_training_id' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Training model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Training the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Training::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new Training; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['Training'][$_POST['editableIndex']]);
				$value=$_POST['Training'][$_POST['editableIndex']][$name];
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
            'query' => Training::find(),
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
			$OpenTBS->VarRef['modelName']= "Training";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'tb_program_id';			
			$data1[]['col2'] = 'revision';			
			$data1[]['col3'] = 'ref_satker_id';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $training){
				$data2[] = [
					'col0'=>$training->id,
					'col1'=>$training->tb_program_id,
					'col2'=>$training->revision,
					'col3'=>$training->ref_satker_id,
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
            'query' => Training::find(),
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
								->setCellValue('A1', 'Tabel Training');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $training){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $training->id)
													  ->setCellValue('B'.$idx, $training->tb_program_id)
													  ->setCellValue('C'.$idx, $training->revision)
													  ->setCellValue('D'.$idx, $training->ref_satker_id);
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
								->setCellValue('A1', 'Tabel Training');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $training){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $training->id)
													  ->setCellValue('B'.$idx, $training->tb_program_id)
													  ->setCellValue('C'.$idx, $training->revision)
													  ->setCellValue('D'.$idx, $training->ref_satker_id);
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
									->setCellValue('A1', 'Tabel Training');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $training){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $training->id)
														  ->setCellValue('B'.$idx, $training->tb_program_id)
														  ->setCellValue('C'.$idx, $training->revision)
														  ->setCellValue('D'.$idx, $training->ref_satker_id);
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
            'query' => Training::find(),
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
						$tb_program_id=  $sheetData[$baseRow]['B'];
						$revision=  $sheetData[$baseRow]['C'];
						$ref_satker_id=  $sheetData[$baseRow]['D'];
						$name=  $sheetData[$baseRow]['E'];
						$start=  $sheetData[$baseRow]['F'];
						$finish=  $sheetData[$baseRow]['G'];
						$note=  $sheetData[$baseRow]['H'];
						$studentCount=  $sheetData[$baseRow]['I'];
						$classCount=  $sheetData[$baseRow]['J'];
						$executionSK=  $sheetData[$baseRow]['K'];
						$resultSK=  $sheetData[$baseRow]['L'];
						$costPlan=  $sheetData[$baseRow]['M'];
						$costRealisation=  $sheetData[$baseRow]['N'];
						$sourceCost=  $sheetData[$baseRow]['O'];
						$hostel=  $sheetData[$baseRow]['P'];
						$reguler=  $sheetData[$baseRow]['Q'];
						$stakeholder=  $sheetData[$baseRow]['R'];
						$location=  $sheetData[$baseRow]['S'];
						$status=  $sheetData[$baseRow]['T'];
						//$created=  $sheetData[$baseRow]['U'];
						//$createdBy=  $sheetData[$baseRow]['V'];
						//$modified=  $sheetData[$baseRow]['W'];
						//$modifiedBy=  $sheetData[$baseRow]['X'];
						//$deleted=  $sheetData[$baseRow]['Y'];
						//$deletedBy=  $sheetData[$baseRow]['Z'];
						$approvedStatus=  $sheetData[$baseRow]['AA'];
						$approvedStatusNote=  $sheetData[$baseRow]['AB'];
						$approvedStatusDate=  $sheetData[$baseRow]['AC'];
						$approvedStatusBy=  $sheetData[$baseRow]['AD'];

						$model2=new Training;
						//$model2->id=  $id;
						$model2->tb_program_id=  $tb_program_id;
						$model2->revision=  $revision;
						$model2->ref_satker_id=  $ref_satker_id;
						$model2->name=  $name;
						$model2->start=  $start;
						$model2->finish=  $finish;
						$model2->note=  $note;
						$model2->studentCount=  $studentCount;
						$model2->classCount=  $classCount;
						$model2->executionSK=  $executionSK;
						$model2->resultSK=  $resultSK;
						$model2->costPlan=  $costPlan;
						$model2->costRealisation=  $costRealisation;
						$model2->sourceCost=  $sourceCost;
						$model2->hostel=  $hostel;
						$model2->reguler=  $reguler;
						$model2->stakeholder=  $stakeholder;
						$model2->location=  $location;
						$model2->status=  $status;
						//$model2->created=  $created;
						//$model2->createdBy=  $createdBy;
						//$model2->modified=  $modified;
						//$model2->modifiedBy=  $modifiedBy;
						//$model2->deleted=  $deleted;
						//$model2->deletedBy=  $deletedBy;
						$model2->approvedStatus=  $approvedStatus;
						$model2->approvedStatusNote=  $approvedStatusNote;
						$model2->approvedStatusDate=  $approvedStatusDate;
						$model2->approvedStatusBy=  $approvedStatusBy;

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
