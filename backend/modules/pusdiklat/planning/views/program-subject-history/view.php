<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectHistory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label'=>'Program History','url'=>['program-history/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = ['label' => 'Program Subject Histories', 'url' => ['index','tb_program_id'=>(int)$tb_program_id,'revision'=>(int)$revision]];
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
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back',['index','tb_program_id'=>(int)$tb_program_id,'revision'=>(int)$revision],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            [
				'attribute' => 'tb_program_subject_id',
				'label'=> 'Program Subject ID',
			],
            [
				'attribute' => 'tb_program_id',
				'label'=> 'Program',
				'value' => $model->program->name,
			],
            'revision',
            'type',
            'name',
            'hours',
            'sort',
            'test',
            'status',
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
