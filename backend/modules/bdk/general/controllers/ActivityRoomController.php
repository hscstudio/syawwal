<?php

namespace backend\modules\bdk\general\controllers;

use Yii;
use backend\models\Meeting;
use backend\models\Training;
use backend\models\Room;
use backend\models\RoomSearch;
use backend\models\ActivityRoom;
use backend\models\ActivityRoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use hscstudio\heart\helpers\Heart;

class ActivityRoomController extends Controller
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

    
    public function actionIndex($roomId = 'all')
    {
    	// roomId null ga boleh
    	if (Yii::$app->request->get('roomId') === null) {
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Room id must be set!');
    		return $this->redirect('list');
    	}

    	if ($roomId != 'all') {
    		$roomSectionTitle = Room::findOne($roomId)->name;
    	}
    	else {
    		$roomSectionTitle = 'All Room';
    	}
    	return $this->render('index', [
    		'roomId' => $roomId,
    		'roomSectionTitle' => $roomSectionTitle
    		]);
    }



    public function actionList()
    {
    	$searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$queryParams['RoomSearch']=[
				'ref_satker_id' => Yii::$app->user->identity->employee->ref_satker_id,
				'status' => 1,
			];
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams);
        
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    public function actionEvents()
	{
		$start = Yii::$app->request->get('start');
		$end = Yii::$app->request->get('end');

		// Klo roomId ga ada
		if (Yii::$app->request->get('roomId') != 'all') {
			// Ambil room id aja
			$model= ActivityRoom::find()
					->where('startTime >= :start and finishTime <= :end and tb_room_id = :romId',[
						':start' => $start,
						':end' => $end,
						':romId' => Yii::$app->request->get('roomId'),
					])
					->all();
		}
		else {
			// Ambil semua
			$model= ActivityRoom::find()
					->where('startTime >= :start and finishTime <= :end',[':start' => $start,':end' => $end])
					->all();
		}
        
		$items = array();

		foreach ($model as $value) {
			
			if ($value->status == 0)
			{
				$color =  '#f0ad4e'; // warning
			}
			
			if ($value->status == 1)
			{
				$color =  '#5bc0de'; // process
			}
			
			if ($value->status == 2)
			{
				$color =  '#5cb85c'; // approved
			}
			
			if ($value->status == 3)
			{
				$color = '#d9534f'; // rejected
			}

			if ($value->type == 0) {
				$title = Training::find()->where(['id' => $value->activity_id])->one()->name.' | '
							.Heart::twodate($value->startTime,$value->finishTime,1).' | ';
			}
			else if ($value->type == 1) {
				$title = Meeting::find()->where(['id' => $value->activity_id])->one()->name.' | '
							.Heart::twodate($value->startTime,$value->finishTime,1).' | ';
			}
			else {
				$title = '<span class="label label default">Type invalid</span>';
			}

			$items[]=[
				'title'=> $title,
				'start'=> date('Y-m-d H:i:s',strtotime($value->startTime)),
				'end'=> date('Y-m-d H:i:s', strtotime($value->finishTime)),
				'color'=> $color,
				'url' => Url::to(['view', 'id' => $value->id])
			];

		}

		echo Json::encode($items);
    }



    public function actionApprove()
    {

    	$activityRoom = ActivityRoom::find()->where(['id' => Yii::$app->request->post('actId')])->one();
    	$activityRoom->status = Yii::$app->request->post('command');

    	if ($activityRoom->save())
    	{
    		switch (Yii::$app->request->post('command'))
    		{
	    		case 0:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> You have revert a room request!');
		    		break;
	    		case 1:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> You have allowed a room request to be processed!');
		    		break;
	    		case 2:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> You have approved a room request!');
		    		break;
	    		case 3:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i> You have rejected a room request!');
		    		break;
    		}
    		return $this->redirect(['index', 'roomId' => $activityRoom->tb_room_id]);
    	}
    	else
    	{
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Failed to commit change!');
    		return $this->redirect(['index', 'roomId' => $activityRoom->tb_room_id]);
    	}
    }



    public function actionView($id)
    {

		$modelActivityRoom = ActivityRoom::find()
		->where(['id' => $id])
		->one();

		if ($modelActivityRoom)
		{
			if (Yii::$app->request->isAjax)
			{
				return $this->renderAjax('view', [
					'modelActivityRoom' => $modelActivityRoom,
				]);
			}
			else
			{
				return $this->render('view', [
					'modelActivityRoom' => $modelActivityRoom,
				]);
			}
		}
    	else
    	{
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Room order record is not exist');
    		return $this->redirect('index');
    	}
    }



}
