<?php

namespace backend\modules\bdk\execution\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Satker;
use backend\models\ActivityRoom;
use backend\models\Room;
use backend\models\Training;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

class TrainingRoomController extends Controller
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
    	if (Yii::$app->request->get('tb_training_id') != null)
    	{
            $satkerModel = Satker::find()->one();

            // Ngecek ada room ga?
            if ( ! $roomModel = Room::find()->where(['ref_satker_id' => Yii::$app->user->identity->employee->ref_satker_id])->one())
            {
                Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> No room! You should create room first!');
                return $this->redirect(Url::to(['training/index'], true));
            }

            $trainingCurrent = Training::find()->where(['id' => Yii::$app->request->get('tb_training_id')])->one();

            $roomList = ArrayHelper::map(Room::find()
                ->select(['id', 'name'])
                ->where(['ref_satker_id' => Yii::$app->user->identity->employee->ref_satker_id])
                ->asArray()
                ->all(),
            'id', 'name');

            $activityRoomDP = new ActiveDataProvider([
                'query' => ActivityRoom::find()->where(['activity_id' => Yii::$app->request->get('tb_training_id')]),
                'pagination' => [
                    'pageSize' => 10
                ]
            ]);

	        $satkerItem = ArrayHelper::map(Satker::find()
	        	->select(['id','name'])
	        	->asArray()
	        	->all(),
	        'id', 'name');

    		return $this->render('index', [
                    'roomList' => $roomList,
                    'roomModel' => $roomModel,
                    'trainingCurrent' => $trainingCurrent,
                    'activityRoomDP' => $activityRoomDP
    			]);
    	}
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i>  You need to choose training first to enter room management page');
            return $this->redirect(Url::to(['training/index'], true));
        }
    }




    public function actionSave()
    {
        $activityRoom = new ActivityRoom;
        $activityRoom->type = 0;
        $activityRoom->activity_id = Yii::$app->request->post('tb_training_id');
        $activityRoom->tb_room_id = Yii::$app->request->post('Room')['id'];
        $activityRoom->startTime = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('startDate').' '.Yii::$app->request->post('startTime')));
        $activityRoom->finishTime = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('endDate').' '.Yii::$app->request->post('endTime')));
        $activityRoom->status = 0;
        $activityRoom->note = null;

        if ($activityRoom->save())
        {
            Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i>A room request has been added');
            return $this->redirect(['index', 'tb_training_id' => $activityRoom->activity_id]);
        }
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i>Failed to save room request!');
            return $this->redirect(Url::to(['training/index'], true));
        }
    }



    public function actionDelete($id)
    {
        $activityId = ActivityRoom::find()->select(['activity_id'])->where(['id' => $id])->one()->activity_id;
        if (ActivityRoom::find()->where(['id' => $id])->one()->delete())
        {
            Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check"></i>A room request has been deleted!');
            return $this->redirect(['index', 'tb_training_id' => $activityId]);
        }
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i>Failed to delete a room request!');
            return $this->redirect(Url::to(['training/index'], true));
        }
    }

}
