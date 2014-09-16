<?php

namespace backend\modules\pusdiklat\execution\controllers;

use Yii;
use backend\models\Training;
use backend\models\TrainingSearch;
use backend\models\ActivityRoom;
use backend\models\RoomSearch;
use backend\models\TrainingClass; 
use backend\models\TrainingClassSearch; 
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

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
					'set' => ['post'],
					'unset' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Training models.
     * @return mixed
     */
     public function actionIndex($year='',$status='all')
    {
		if(empty($year)) $year = date('Y');
		$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		
        $searchModel = new TrainingSearch();
		$queryParams = Yii::$app->request->getQueryParams();
		if($status!='all'){
			if($year!='all'){
				$queryParams['TrainingSearch']=[
					'year' => $year,
					'ref_satker_id'=>$ref_satker_id,
					'status'=>$status,
				];
			}
			else{
				$queryParams['TrainingSearch']=[
					'ref_satker_id'=>$ref_satker_id,
					'status'=>$status,
				];
			}
		}
		else{
			if($year!='all'){
				$queryParams['TrainingSearch']=[
					'year' => $year,
					'ref_satker_id'=>$ref_satker_id,
				];
			}
			else{
				$queryParams['TrainerSearch']=[
					'ref_satker_id'=>$ref_satker_id,
				];
			}
		}
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
		$dataProvider->getSort()->defaultOrder = ['start'=>SORT_ASC,'finish'=>SORT_ASC];
		
		// GET ALL TRAINING YEAR
		$year_training = yii\helpers\ArrayHelper::map(Training::find()
			->select(['year'=>'YEAR(start)','start','finish'])
			->orderBy(['year'=>'DESC'])
			->groupBy(['year'])
			->currentSatker()
			->active()
			->asArray()
			->all(), 'year', 'year');
		$year_training['all']='All'	;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'year' => $year,
			'status' => $status,
			'year_training' => $year_training,
        ]);
    }

    /**
     * Displays a single Training model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
        if (Yii::$app->request->isAjax){	
			return $this->renderAjax('view', [
				'model' => $model,
			]);
		}
		else{
			return $this->render('view', [
				'model' => $model,
			]);
		}
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
		if(in_array($model->status,[1,2])){
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
		else{
			
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
			$data1[]['col2'] = 'tb_program_revision';			
			$data1[]['col3'] = 'ref_satker_id';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $training){
				$data2[] = [
					'col0'=>$training->id,
					'col1'=>$training->tb_program_id,
					'col2'=>$training->tb_program_revision,
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
													  ->setCellValue('C'.$idx, $training->tb_program_revision)
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
													  ->setCellValue('C'.$idx, $training->tb_program_revision)
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
														  ->setCellValue('C'.$idx, $training->tb_program_revision)
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
						$tb_program_revision=  $sheetData[$baseRow]['C'];
						$ref_satker_id=  $sheetData[$baseRow]['D'];
						$number=  $sheetData[$baseRow]['E'];
						$name=  $sheetData[$baseRow]['F'];
						$start=  $sheetData[$baseRow]['G'];
						$finish=  $sheetData[$baseRow]['H'];
						$note=  $sheetData[$baseRow]['I'];
						$studentCount=  $sheetData[$baseRow]['J'];
						$classCount=  $sheetData[$baseRow]['K'];
						$executionSK=  $sheetData[$baseRow]['L'];
						$resultSK=  $sheetData[$baseRow]['M'];
						$costPlan=  $sheetData[$baseRow]['N'];
						$costRealisation=  $sheetData[$baseRow]['O'];
						$sourceCost=  $sheetData[$baseRow]['P'];
						$hostel=  $sheetData[$baseRow]['Q'];
						$reguler=  $sheetData[$baseRow]['R'];
						$stakeholder=  $sheetData[$baseRow]['S'];
						$location=  $sheetData[$baseRow]['T'];
						$status=  $sheetData[$baseRow]['U'];
						//$created=  $sheetData[$baseRow]['V'];
						//$createdBy=  $sheetData[$baseRow]['W'];
						//$modified=  $sheetData[$baseRow]['X'];
						//$modifiedBy=  $sheetData[$baseRow]['Y'];
						//$deleted=  $sheetData[$baseRow]['Z'];
						//$deletedBy=  $sheetData[$baseRow]['AA'];
						$approvedStatus=  $sheetData[$baseRow]['AB'];
						$approvedStatusNote=  $sheetData[$baseRow]['AC'];
						$approvedStatusDate=  $sheetData[$baseRow]['AD'];
						$approvedStatusBy=  $sheetData[$baseRow]['AE'];

						$model2=new Training;
						//$model2->id=  $id;
						$model2->tb_program_id=  $tb_program_id;
						$model2->tb_program_revision=  $tb_program_revision;
						$model2->ref_satker_id=  $ref_satker_id;
						$model2->number=  $number;
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
	
	/**
     * Lists all Room models.
     * @return mixed
     */
    public function actionRoom($activity_id, $ref_satker_id=0)
    {
		$activity=$this->findModel($activity_id);	      
		if($ref_satker_id===0) $ref_satker_id = (int)$activity->location;
		if($ref_satker_id<0) $ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		
		$searchModel = new \backend\models\ActivityRoomSearch();
		$queryParams['ActivityRoomSearch']=[				
			'activity_id'=>$activity_id,
		];		
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
        $dataProvider = $searchModel->search($queryParams);

		// GET ALL TRAINING YEAR
		$satkers['all']='All';
		$satkers = yii\helpers\ArrayHelper::map(\backend\models\Satker::find()
			//->select(['year'=>'YEAR(start)','start','finish'])
			->orderBy(['eselon'=>'ASC',])
			//->active()
			->asArray()
			->all(), 'id', 'name');
		
		if (Yii::$app->request->isAjax){
			return $this->renderAjax('room', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'activity_id'=>$activity_id,
				'activity'=>$activity,
				'ref_satker_id'=>$ref_satker_id,
				'satkers'=>$satkers,
			]);
		}
		else{
			return $this->render('room', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'activity_id'=>$activity_id,
				'activity'=>$activity,
				'ref_satker_id'=>$ref_satker_id,
				'satkers'=>$satkers,
			]);
		}
    }
	
	/**
     * Lists all Room models.
     * @return mixed
     */
    public function actionAvailableRoom($activity_id)
    {
		$activity=$this->findModel($activity_id);	
		$post = Yii::$app->request->post('ActivityRoomExtSearch');
		$wheres = [];
		if($post['computer']==1) $wheres[] = 'computer=1';
		if($post['hostel']==1) $wheres[] = 'hostel=1';
		if($post['capacity']>0) $wheres[] = 'capacity>='.$post['capacity'];
		if($post['location']!='all') $wheres[] = 'ref_satker_id='.$post['location'];
		$where = implode(' AND ',$wheres);
		$model = \backend\models\Room::find()->where(
			$where
		)->all();
		
		$start = date('Y-m-d H:i',strtotime($post['startDateX'].' '.$post['startTimeX'])); 
		$finish = date('Y-m-d H:i',strtotime($post['finishDateX'].' '.$post['finishTimeX']));   
		echo "<strong>List of Available Room</strong><hr>";
		echo '<div class="table-responsive">
		<table class="table table-hover table-bordered table-striped">
		<thead>
		<tr>
			<th>No</th>
			<th>Room</th>
			<th>Capacity</th>
			<th>Computer</th>
			<th>Hostel</th>
			<th>Action</th>
		</th>
		</thead>
		<tbody>';
		$idx=0;
		$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		foreach($model as $data){				
			// ONLY CHECK AVAILABILITY
			$activityRoom = \backend\models\ActivityRoom::find()
					->where('
						((startTime between :start AND :finish)
							OR (finishTime between :start AND :finish))
						AND 
						tb_room_id = :tb_room_id
						AND
						status = :status
					',
					[
						':start' => $start,
						':finish' => $finish,
						':tb_room_id' => $data->id,
						':status' => 2,
					]);
					
			// IS AVAILABLE			
			if($activityRoom->count()==0){ 
				$activityRoom2 = \backend\models\ActivityRoom::find()
						->where('
							tb_room_id = :tb_room_id 
							AND
							activity_id = :activity_id
							AND
							status!=3
						',
						[
							':tb_room_id' => $data->id,
							':activity_id' => $activity->id,
						]);
				if($activityRoom2->count()==0){ 
					$idx++;
					echo '<tr>';
					echo '<td>'.$idx.'</td>';
					echo '<td>';
					echo $data->name;
					if($data->ref_satker_id!=$ref_satker_id){
						echo '<br><span class="badge">'.$data->satker->name.'</span>';
					}
					echo '</td>';
					echo '<td>'.$data->capacity.'</td>';
					echo '<td>'.$data->computer.'</td>';
					echo '<td>'.$data->hostel.'</td>';
					echo '<td>';
					echo Html::a('<span class="fa fa-square-o"></span>', 
						[
						'set',
						'activity_id'=>$activity->id,
						'tb_room_id'=>$data->id
						], 
						[
						'class' => 'label label-info link-post','data-pjax'=>0,
						'title'=>'click to set it!',
						'data-toggle'=>"tooltip",
						'data-placement'=>"top",
						]);
					echo '</td>';
					echo '</tr>';
				}
				else{
					//echo '<tr>';
					//echo '<td colspan="6">unavailable.. coming soon :)</td>';
					//echo '</tr>';
				}
			}
			// IS NOT AVAILABLE	
			else{
				echo '<tr>';
				echo '<td colspan="6">unavailable.. coming soon :)</td>';
				echo '</tr>';
			}
		}
		echo '
		</tbody>
		</table>
		</div>
		<hr>';
		echo '<script>			
				$( "a.link-post" ).click(function() {
					if(!confirm("Are you sure set it??")) return false;	
					$.ajax({
						url: $(this).attr("href"),
						type: "post",
						data: $("#form-available-room").serialize(),
						success: function(data) {
							$("#form-available-room").submit();
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['room','activity_id'=>$activity_id]).'",
								container: "#pjax-gridview-room", 
								timeout: 3000,
							});							
						},
						error:  function( jqXHR, textStatus, errorThrown ) {
							$("#available-room").html(jqXHR.responseText);
						}
					});	
					return false;
				});
			 </script>';
	}
	/**
     * Creates a new Meeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSet($activity_id,$tb_room_id)
    {
		$activity=$this->findModel($activity_id);	
		$post = Yii::$app->request->post('ActivityRoomExtSearch');
		/*$wheres = [];
		if($post['computer']==1) $wheres[] = 'computer=1';
		if($post['hostel']==1) $wheres[] = 'hostel=1';
		if($post['capacity']>0) $wheres[] = 'capacity>='.$post['capacity'];
		if($post['location']!='all') $wheres[] = 'ref_satker_id='.$post['location'];
		$where = implode(' AND ',$wheres);
		*/	
		$room = \backend\models\Room::findOne($tb_room_id);
		$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;		
		$status = ($room->ref_satker_id==$ref_satker_id)?1:0;
		$start = date('Y-m-d H:i',strtotime($post['startDateX'].' '.$post['startTimeX'])); 
		$finish = date('Y-m-d H:i',strtotime($post['finishDateX'].' '.$post['finishTimeX']));
		
        $model = new ActivityRoom();
		$model->type = 0; // TRAINING
		$model->activity_id = (int)$activity_id;
		$model->tb_room_id = (int)$tb_room_id;
		$model->startTime = $start;
		$model->finishTime = $finish;
		$model->status = $status;
		
        if($model->save()) {
			Yii::$app->session->setFlash('success', 'Room have setted');
		}
		else{
			 Yii::$app->session->setFlash('error', 'Unable set, there are some error');
		}
		if (Yii::$app->request->isAjax){	
			return ('Room have setted');
		}
		else{
			return $this->redirect(['room', 'activity_id' => $activity_id]);
		}
    }
	
	public function actionUnset($activity_id,$tb_room_id)
    {
		$room = \backend\models\Room::findOne($tb_room_id);
		$model = ActivityRoom::find()->where(
			'activity_id=:activity_id AND tb_room_id=:tb_room_id',[':activity_id'=>$activity_id,':tb_room_id'=>$tb_room_id])->one();
		$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$msg="-";
		
		if($room->ref_satker_id==$ref_satker_id and $model->status!=1){
			if (Yii::$app->request->isAjax){	
				$msg = ('You have not privileges to unset this data');
			}
			else{
				Yii::$app->session->setFlash('error', 'You have not privileges to unset this data');
			}
		}
		else if($room->ref_satker_id!=$ref_satker_id and $model->status!=0){
			if (Yii::$app->request->isAjax){	
				$msg = ('You have not privileges to unset this data');
			}
			else{
				Yii::$app->session->setFlash('error', 'You have not privileges to unset this data');
			}
		}
		else
		{
			if($model->delete()) {
				Yii::$app->session->setFlash('success', 'Room have unset');
			}
			else{
				 Yii::$app->session->setFlash('error', 'Unable unset there are some error');
			}
		}

		if (Yii::$app->request->isAjax){	
			echo $msg;
		}
		else{
			return $this->redirect(['room', 'activity_id' => $activity_id]);
		}		
		
    }

	/**
     * Displays a single Training model.
     * @param integer $id
     * @return mixed
     */
    public function actionDashboard($id)
    {
        return $this->render('dashboard', [
            'model' => $this->findModel($id),
        ]);
    }
	
	/**
     * Displays a single Training model.
     * @param integer $id
     * @return mixed
     */
    public function actionTrainer($id)
    {
		$trainingTrainers = \backend\models\TrainingScheduleTrainer::find()
			->where([
				'tb_training_schedule_id'=>
					\backend\models\TrainingSchedule::find()
						->select('id')
						->where([
							'tb_training_class_id'=>
								\backend\models\TrainingClass::find()
									->select('id')
									->where([
										'tb_training_id'=>$id,
										'status'=>1,
									]),
							'status'=>1,
						]),
				'status'=>1,
			])
			->groupBy('tb_trainer_id')
			->all();
        if (Yii::$app->request->isAjax){	
			return $this->renderAjax('trainer', [
				'model' => $this->findModel($id),
				'trainingTrainers' => $trainingTrainers,
			]);
		}
		else{
			return $this->render('trainer', [
				'model' => $this->findModel($id),
				'trainingTrainers' => $trainingTrainers,
			]);
		}
    }
	
}
