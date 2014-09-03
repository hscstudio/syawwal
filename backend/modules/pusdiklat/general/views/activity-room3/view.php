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
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i>',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            'id',
            'type',
            'activity_id',
            [
				'attribute' => 'tb_room_id',
				'value' => $model->room->name,
			],
            'tb_room_id',
            'startTime',
            'finishTime',
            'note',
            'status',
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
        ],
    ]) ?>

</div>
