<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubject */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['training/index']];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words('Subject : '.$training_name), 'url' => ['index','tb_training_id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-subject-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Program Subjects # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_training_id'=>$model->id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            'id',
            [
				'attribute' => 'tb_program_id',
				'label'=>'Program',
				'value' => $model->program->name,
			],
            [
				'format'=>'raw',
				'attribute' => 'ref_subject_type_id',
				'label'=>'Type',
				'value' => '<span class="badge">'.$model->subjectType->name.'</span>',
			],	
			
            'name',
            'hours',
            'sort',
            'test',
            [
				'format' => 'html',
				'attribute' => 'status',
				'value' => Html::a(($model->status==1)?'<span class="glyphicon glyphicon-ok"></span> Published':'<span class="glyphicon glyphicon-remove"></span> Unpublished', '#', [
						'class'=>($model->status==1)?'label label-info':'label label-warning',
					]),
			],
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
