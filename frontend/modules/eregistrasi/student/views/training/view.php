<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Training */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Trainings # ' . $model->id,
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
            'id',
            [
				'attribute' => 'tb_program_id',
				'value' => $model->program->name,
			],
            'tb_program_id',
            [
				'attribute' => 'tb_program_revision',
				'value' => '',
			],
            'tb_program_revision',
            [
				'attribute' => 'ref_satker_id',
				'value' => '',//$model->satker->name,
			],
            'ref_satker_id',
            'number',
            'name',
            'start',
            'finish',
            'note',
            'studentCount',
            'classCount',
            'executionSK',
            'resultSK',
            'costPlan',
            'costRealisation',
            'sourceCost',
            'hostel',
            'reguler',
            'stakeholder',
            'location',
            'status',
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
            'approvedStatus',
            'approvedStatusNote',
            'approvedStatusDate',
            'approvedStatusBy',
        ],
    ]) ?>

</div>
