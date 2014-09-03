<?php

namespace backend\modules\bdk\general\controllers;

use Yii;
use backend\models\Training;
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

    
    public function actionIndex()
    {
    	return $this->render('index');
    }



    public function actionEvents()
	{
		$start = Yii::$app->request->get('start');
		$end = Yii::$app->request->get('end');
        
		$items = array();
		$model= ActivityRoom::find()
				->where('startTime >= :start and finishTime <= :end',[':start' => $start,':end' => $end])
				->all();

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

			$items[]=[
				'title'=> Training::find()->where(['id' => $value->activity_id])->one()->name.' | '
							.Heart::twodate($value->startTime,$value->finishTime,1).' | ',
				'start'=> date('Y-m-d H:i:s',strtotime($value->startTime)),
				'end'=> date('Y-m-d H:i:s', strtotime('+1 day', strtotime($value->finishTime))),
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
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i> You have revert a room request!');
		    		break;
	    		case 1:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i> You have allowed a room request to be processed!');
		    		break;
	    		case 2:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i> You have approved a room request!');
		    		break;
	    		case 3:
		    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i> You have rejected a room request!');
		    		break;
    		}
    		return $this->redirect('index');
    	}
    	else
    	{
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Failed to commit change!');
    		return $this->redirect('index');
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
