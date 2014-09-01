<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectHistory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program2/index']];
$this->params['breadcrumbs'][] = ['label'=> \yii\helpers\Inflector::camel2words('History : '.$program_name),'url'=>['program-history2/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words('History Subject : '.$program_history_name), 'url' => ['index','tb_program_id'=>(int)$tb_program_id,'revision'=>(int)$revision]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-subject-history-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Program Subject Histories # ' ,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_program_id'=>(int)$tb_program_id,'revision'=>(int)$revision],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            [
				'attribute' => 'tb_program_subject_id',
				'label'=> 'ID',
			],
            [
				'attribute' => 'tb_program_id',
				'label'=> 'Program',
				'value' => $model->program->name,
			],
            [
				'format' => 'html',
				'attribute' => 'revision',
				'value' => Html::a(($model->revision>0)?$model->revision.'x':'-', '#', [
						'class'=>'label label-danger',
					]),
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
