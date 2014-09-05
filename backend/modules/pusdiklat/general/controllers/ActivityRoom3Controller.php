<?php

namespace backend\modules\pusdiklat\general\controllers;

use Yii;
use backend\models\ActivityRoom;
use backend\models\ActivityRoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityRoomController implements the CRUD actions for ActivityRoom model.
 */
class ActivityRoom3Controller extends Controller
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
     * Lists all ActivityRoom models.
     * @return mixed
     */
    public function actionIndex($tb_room_id,$status='all')
    {
        $ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$searchModel = new ActivityRoomSearch();
        $queryParams = Yii::$app->request->getQueryParams();
		$params = [];
		if($status=='all') $params = ['tb_room_id' => $tb_room_id,'ref_satker_id' => $ref_satker_id,];
		else $params = ['tb_room_id' => $tb_room_id,'ref_satker_id' => $ref_satker_id,'status' => $status,];
		$queryParams['ActivityRoomSearch']=$params;
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
		$dataProvider->getSort()->defaultOrder = ['startTime'=>SORT_DESC,'finishTime'=>SORT_DESC];
		
		$room = \backend\models\Room::findOne($tb_room_id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'room' => $room,
			'tb_room_id' => $tb_room_id,
			'status' => $status,
        ]);
    }
	
	
    /**
     * Displays a single ActivityRoom model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = ActivityRoom::find()->where(['id'=>$id])->one();        
		if (Yii::$app->request->isAjax){		
			return $this->renderAjax('view', [
				'model' => $model,
				'tb_room_id' => $model->tb_room_id,
			]);
		}
		else{
			return $this->render('view', [
				'model' => $model,
				'tb_room_id' => $model->tb_room_id,
			]);
		}
    }

    /**
     * Creates a new ActivityRoom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($tb_room_id)
    {
        $model = new ActivityRoom();

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
				'tb_room_id' => $tb_room_id,
            ]);
        }
    }

    /**
     * Updates an existing ActivityRoom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$model = ActivityRoom::find()->where(['id'=>$id])->one();        
		//CHECKING ACTIVITY ID OF CURRENT SATKER
		if($model->type==0){
			$training = \backend\models\Training::findOne($model->activity_id);
			if($training->ref_satker_id!=$ref_satker_id){
				Yii::$app->session->setFlash('error', 'You have not privileges to update this activity!');
				return $this->redirect(['index','tb_room_id'=>$model->tb_room_id]);
			}
		}
		
        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
				Yii::$app->session->setFlash('success', 'Data saved');
				if (Yii::$app->request->isAjax){

				}
				else
					return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
				Yii::$app->session->setFlash('error', 'There are some errors');
				if (Yii::$app->request->isAjax){		
				
				}
				else
					return $this->redirect(['index','tb_room_id'=>$model->tb_room_id]);
            }            
        }
		else{
			//return $this->render(['update', 'id' => $model->id]);
			return $this->render('update', [
                'model' => $model,
				'tb_room_id' => $model->tb_room_id,
            ]);
		}
    }

    /**
     * Deletes an existing ActivityRoom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$model = ActivityRoom::find($id)->one();        
		//CHECKING ACTIVITY ID OF CURRENT SATKER
		if($model->type==0){
			$training = \backend\models\Training::findOne($model->activity_id);
			if($training->ref_satker_id!=$ref_satker_id){
				Yii::$app->session->setFlash('error', 'You have not privileges to delete this activity!');
				return $this->redirect(['index','tb_room_id'=>$model->tb_room_id]);
			}
		}
		$model->delete();
        return $this->redirect(['index']);
    }
	*/
    /**
     * Finds the ActivityRoom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityRoom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityRoom::find($id)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new ActivityRoom; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['ActivityRoom'][$_POST['editableIndex']]);
				$value=$_POST['ActivityRoom'][$_POST['editableIndex']][$name];
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
            'query' => ActivityRoom::find(),
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
			$OpenTBS->VarRef['modelName']= "ActivityRoom";
			$data1[]['col0'] = 'id';			
			$data1[]['col1'] = 'type';			
			$data1[]['col2'] = 'activity_id';			
			$data1[]['col3'] = 'tb_room_id';			
	
			$OpenTBS->MergeBlock('a', $data1);			
			$data2 = [];
			foreach($dataProvider->getModels() as $activityroom){
				$data2[] = [
					'col0'=>$activityroom->id,
					'col1'=>$activityroom->type,
					'col2'=>$activityroom->activity_id,
					'col3'=>$activityroom->tb_room_id,
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
            'query' => ActivityRoom::find(),
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
								->setCellValue('A1', 'Tabel ActivityRoom');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $activityroom){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $activityroom->id)
													  ->setCellValue('B'.$idx, $activityroom->type)
													  ->setCellValue('C'.$idx, $activityroom->activity_id)
													  ->setCellValue('D'.$idx, $activityroom->tb_room_id);
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
								->setCellValue('A1', 'Tabel ActivityRoom');
					$idx=2; // line 2
					foreach($dataProvider->getModels() as $activityroom){
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $activityroom->id)
													  ->setCellValue('B'.$idx, $activityroom->type)
													  ->setCellValue('C'.$idx, $activityroom->activity_id)
													  ->setCellValue('D'.$idx, $activityroom->tb_room_id);
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
									->setCellValue('A1', 'Tabel ActivityRoom');
						$idx=2; // line 2
						foreach($dataProvider->getModels() as $activityroom){
							$objPHPExcel->getActiveSheet()->setCellValue('A'.$idx, $activityroom->id)
														  ->setCellValue('B'.$idx, $activityroom->type)
														  ->setCellValue('C'.$idx, $activityroom->activity_id)
														  ->setCellValue('D'.$idx, $activityroom->tb_room_id);
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
	
	/**
     * Lists all ActivityRoom models.
     * @return mixed
     */
    public function actionCalendar($tb_room_id,$status='all')
    {
        /*
		$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
		$searchModel = new ActivityRoomSearch();
        $queryParams = Yii::$app->request->getQueryParams();
		$params = [];
		if($status=='all') $params = ['tb_room_id' => $tb_room_id,'ref_satker_id' => $ref_satker_id,];
		else $params = ['tb_room_id' => $tb_room_id,'ref_satker_id' => $ref_satker_id,'status' => $status,];
		$queryParams['ActivityRoomSearch']=$params;
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
		$dataProvider->getSort()->defaultOrder = ['startTime'=>SORT_DESC,'finishTime'=>SORT_DESC];*/
		
		$room = \backend\models\Room::findOne($tb_room_id);
        return $this->render('calendar', [
			'room' => $room,
			'tb_room_id' => $tb_room_id,
			'status' => $status,
        ]);
    }
	
	public function actionEvents($tb_room_id,$status='all')
	{
		$start = Yii::$app->request->get('start');
		$end = Yii::$app->request->get('end');
        
		$items = array();
		if($status=='all'){
			$model= \backend\models\ActivityRoom::find()
					 ->where('(startTime >= :start and finishTime<= :end) and tb_room_id=:tb_room_id',
						[':start' => $start,':end' => $end,':tb_room_id' => $tb_room_id])
					 ->all();  
		}
		else{
			$model= \backend\models\ActivityRoom::find()
					 ->where('startTime >= :start and finishTime<= :end and tb_room_id=:tb_room_id and status=:status',
						[':start' => $start,':end' => $end,':tb_room_id' => $tb_room_id,':status' => $status])
					 ->all();   
		}
		
		$title = 'Untitle';
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		$color = '';
		$link = '';
		foreach ($model as $value) {
			
			if($value->type==0){
				$activity = \backend\models\Training::find()
					 ->where('id >= :id ',[':id' => $value->activity_id])
					 ->one();				
			}
			else{
				$activity = \backend\models\Meeting::find()
					 ->where('id >= :id ',[':id' => $value->activity_id])
					 ->one();
			}
			
			$title = $activity->name;
			if($activity->ref_satker_id!=Yii::$app->user->identity->employee->ref_satker_id){
				$title.=' ['.$activity->satker->shortname.'] ';
			}
			$title .= ' | '.\hscstudio\heart\helpers\Heart::twodate($value->startTime,$value->finishTime,1);
			$start=date('Y-m-d H:i:s',strtotime($value->startTime));
			$end=date('Y-m-d H:i:s', strtotime('+1 day', strtotime($value->finishTime)));
			if($value->status==0) $color='#f0ad4e';
			else if($value->status==1) $color='#5bc0de';
			else if($value->status==2) $color='#5cb85c';
			else if($value->status==3) $color='#d9534f';
			$link = \yii\helpers\Url::to(['view','id'=>$value->id]);			
			
			$items[]=[
				'title'=> $title,
				'start'=> $start,
				'end'=> $end,
				'color'=> $color,
				//'allDay'=>true,
				'url'=>$link
			];
		}
		echo \yii\helpers\Json::encode($items);
    }
}
