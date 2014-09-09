<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityRoom */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="activity-room-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Activity Rooms # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i>',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
           
			[
				'attribute' => 'type',
				'value' => $model->type == '0'?'Training':'Meeting',
			],
			[
				'attribute' => 'activity_name',
				'value' => \backend\models\Training::findOne($model->activity_id)->name,
			],
            [
				'attribute' => 'room_name',
				'value' => $model->room->name,
			],
            'startTime',
            'finishTime',
            'note',
			[
				'attribute' => 'status',
				'value' => ($model->status == '1')?'Process':($model->status == '2')?'Approved':'Rejected',
				//:'Rejected',
			],
            //'status',
            'created',
            [
				'attribute' => 'createdBy',
				'value' => \backend\models\User::findOne($model->createdBy)->username,
			],
            'modified',
            [
				'attribute' => 'modifiedBy',
				'value' => \backend\models\User::findOne($model->modifiedBy)->username,
			],
        ],
    ]) ?>

</div>
