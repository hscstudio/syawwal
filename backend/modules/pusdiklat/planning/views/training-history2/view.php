<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingHistory */

$this->title = \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['Training/index']];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words('History : '.$training_name), 'url' => ['index','tb_training_id'=>$model->tb_training_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-history-view">
	<?php
	function showLabel($status){
		if ($status==1){
			$icon='<span class="glyphicon glyphicon-check"></span>';
			$label='label label-info';
			$title='READY';
		}	
		else if ($status==2){ 
			$icon='<span class="glyphicon glyphicon-refresh"></span>';
			$label='label label-success';
			$title='EXECUTE';
		}
		else if ($status==3){ 
			$icon='<span class="glyphicon glyphicon-trash"></span>';
			$label='label label-danger';
			$title='CANCEL';
		}
		else {
			$icon='<span class="glyphicon glyphicon-fire"></span>';
			$label='label label-warning';
			$title='PLAN';
		}
		return Html::tag('span', $icon.' '.$title, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
	}
	?>
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Histories # ' . $model->tb_training_id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_training_id'=>$model->tb_training_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' ',
        'attributes' => [
            [
				'attribute' => 'tb_program_id',
				//'value' => $model->program->name,
			],
            [
				'format' => 'html',
				'attribute' => 'tb_program_revision',
				'value' => Html::a(($model->tb_program_revision>0)?$model->tb_program_revision.'x':'-', '#', [
						'class'=>'label label-danger',
					]),
			],
			[
				'format' => 'html',
				'attribute' => 'revision',
				'value' => Html::a(($model->revision>0)?$model->revision.'x':'-', '#', [
						'class'=>'label label-danger',
					]),
			],
            [
				'attribute' => 'ref_satker_id',
				//'value' => $model->satker->name,
			],
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
            [
				'format' => 'html',
				'attribute' => 'status',
				'value' => showLabel($model->status),
			],
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
