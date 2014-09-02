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
				$color =  '#f0ad4e';
			}
			else
			{
				$color = '#5cb85c';
			}

			$items[]=[
				'title'=> Training::find()->where(['id' => $value->activity_id])->one()->name.' | '
							.Heart::twodate($value->startTime,$value->finishTime,1).' | ',
				'start'=> date('Y-m-d H:i:s',strtotime($value->startTime)),
				'end'=> date('Y-m-d H:i:s', strtotime('+1 day', strtotime($value->finishTime))),
				'color'=> $color,
				'editable' => true,
				'url' => Url::to(['view', 'id' => $value->id])
			];

		}

		echo Json::encode($items);
    }



    public function actionApprove()
    {

    	$activityRoom = ActivityRoom::find()->where(['id' => yii::$app->request->post('actId')])->one();

    	if ($activityRoom->save())
    	{
    		Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i> You have approved a room request!');
    		return $this->redirect('index');
    	}
    	else
    	{
    		Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Somehow you failed to approve a room request..');
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
