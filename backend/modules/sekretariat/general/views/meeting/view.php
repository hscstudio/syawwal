<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Meeting */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="meeting-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Meetings # ' . $model->id,
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
				'attribute' => 'ref_satker_id',
				'value' => $model->satker->name,
			],
            'executor',
            'name',
            'startTime',
            'finishTime',
            'note',
            'attendanceCount',
            'classCount',
			[
				'attribute' => 'hostel',
				'value' => $model->hostel=='0'?'No':'Yes',
			],
			[
				'attribute' => 'location',
				'value' => $model->satker->name,
			],
			[
				'attribute' => 'status',
				'value' => $model->status=='0'?'No':'Yes',
			],
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
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
