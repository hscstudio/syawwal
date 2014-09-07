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
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use kartik\widgets\ActiveForm;

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
        $activityRoom->tb_room_id = Yii::$app->request->post('tb_room_id');
        $activityRoom->startTime = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('startTime')));
        $activityRoom->finishTime = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('finishTime')));
        $activityRoom->status = 0;
        $activityRoom->note = null;

        if ($activityRoom->save())
        {
            Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i>A room request has been added');
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
            Yii::$app->session->setFlash('success', '<i class="fa fa-fw fa-check-circle"></i>A room request has been deleted!');
            return $this->redirect(['index', 'tb_training_id' => $activityId]);
        }
        else
        {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i>Failed to delete a room request!');
            return $this->redirect(Url::to(['training/index'], true));
        }
    }



    public function actionSearch()
    {
        // Cuma request ajax yg bisa panggil fungsi ini
        if ( ! Yii::$app->request->isAjax) {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> Forbidden');
            return $this->redirect(['index', 'tb_training_id' => Yii::$app->request->post('tb_training_id')]);
        }
        // Semua room
        $roomList = Room::find()->where(['ref_satker_id' => Yii::$app->user->identity->employee->ref_satker_id])->all();

        // Mbikin table
        $result = '<table class="table table-bordered table-hover table-striped">';
        $result .= '<thead><tr><th>List Room Available</th><th>Action</th></tr></thead><tbody>';
        foreach ($roomList as $k) {
            $result .= '<tr>';
            $result .= '<td>'.$k->name.' ';
            if ($this->isCollide($k->id, Yii::$app->request->post('startTime'), Yii::$app->request->post('finishTime'))) {
                $result .= $this->getCollideDate($k->id, Yii::$app->request->post('startTime'), Yii::$app->request->post('finishTime'));
            }
            $result .= '</td>';
            $result .= '<td style="width:80px">';

            $result .= Html::beginForm(
                            Url::to(['training-room/save']),
                            'post', [
                                'id' => 'order-room-form',
                            ]
                        );
            $result .= Html::hiddenInput('tb_training_id', Yii::$app->request->post('tb_training_id'));
            $result .= Html::hiddenInput('tb_room_id', $k->id);
            $result .= Html::hiddenInput('startTime', date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('startTime'))));
            $result .= Html::hiddenInput('finishTime', date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('finishTime'))));
            if ($this->isCollide($k->id, Yii::$app->request->post('startTime'), Yii::$app->request->post('finishTime'))) {
                $result .= '<div class="label label-danger"><i class="fa fa-fw fa-times-circle"></i>
                    Used
                </div>';
            }
            else {
                $result .= Html::submitButton('<i class="fa fa-fw fa-play"></i>Request', [
                                    'class' => 'btn btn-primary btn-xs',
                                ]);
            }
            $result .= Html::endForm();
            $result .=  '</td>';
            $result .= '</tr>';
        }
        $result .= '</tbody></table>';

        echo $result;
    }



    private function isCollide($roomId, $startTime, $finishTime) {
        // Semua argumen ga boleh null
        if ($roomId == null or $startTime == null or $finishTime == null) {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> isCollide arguments is not valid');
            return $this->redirect(Url::to(['training/index']));
        }

        // Reformat argumen
        $startTime = date('d M Y H:i:s', strtotime($startTime));
        $finishTime = date('d M Y H:i:s', strtotime($finishTime));

        // Ambil activity room
        $actRoom = ActivityRoom::find()->where(['tb_room_id' => $roomId])->all(); 

        // Cek
        if ($actRoom) {
            foreach ($actRoom as $k) {
                // Klo startTime masuk range time di argumen
                if (date('d M Y H:i:s', strtotime($k->startTime)) >= $startTime and date('d M Y H:i:s', strtotime($k->startTime)) <= $finishTime) {
                    // Artinya collide, lempar dah
                    return true;
                }
                // Klo finishTime masuk range time di argumen
                if (date('d M Y H:i:s', strtotime($k->finishTime)) >= $startTime and date('d M Y H:i:s', strtotime($k->finishTime)) <= $finishTime) {
                    // Artinya collide, lempar dah
                    return true;
                }
            }
            // Ga ada 1 pun activity yang tanggalnya collide
            return false;
        }
        else {
            // activity room ga ada
            return false;
        }

    }




    private function getCollideDate($roomId, $startTime, $finishTime) {
        // Semua argumen ga boleh null
        if ($roomId == null or $startTime == null or $finishTime == null) {
            Yii::$app->session->setFlash('error', '<i class="fa fa-fw fa-times-circle"></i> isCollide arguments is not valid');
            return $this->redirect(Url::to(['training/index']));
        }

        // Reformat argumen
        $startTime = date('d M Y H:i:s', strtotime($startTime));
        $finishTime = date('d M Y H:i:s', strtotime($finishTime));

        // Ambil activity room
        $actRoom = ActivityRoom::find()->where(['tb_room_id' => $roomId])->all(); 

        // Cek
        $fOut = '';
        if ($actRoom) {
            foreach ($actRoom as $k) {
                $fOut .= '<span class="label label-default">';
                // Klo startTime masuk range time di argumen
                if (date('d M Y H:i:s', strtotime($k->startTime)) >= $startTime and date('d M Y H:i:s', strtotime($k->startTime)) <= $finishTime) {
                    $fOut .= date('D, d M Y H:i:s', strtotime($k->startTime)). ' to ';
                }
                // Klo finishTime masuk range time di argumen
                if (date('d M Y H:i:s', strtotime($k->finishTime)) >= $startTime and date('d M Y H:i:s', strtotime($k->finishTime)) <= $finishTime) {
                    // Artinya collide, lempar dah
                    $fOut .= date('D, d M Y H:i:s', strtotime($k->finishTime));
                }
                $fOut .= '</span> ';
            }
            return $fOut;
        }
        else {
            return '';
        }

    }

}
