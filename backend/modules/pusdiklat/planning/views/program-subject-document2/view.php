<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectDocument */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program2/index']];
$this->params['breadcrumbs'][] = ['label'=> \yii\helpers\Inflector::camel2words('Subject : '.$program_name),'url'=>['program-subject2/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = ['label' => 'Document : '.$program_subject_name, 'url' => ['index','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-subject-document-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Program Subject Documents # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> DELETE',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            'id',
            [
				'attribute' => 'tb_program_subject_id',
				'label' => 'Program Subject',
				'value' => $model->programSubject->name,
			],
            'revision',
            'name',
            'type',
            [
				'format' => 'html',
				'attribute' => 'filename',
				'label' => 'Filename',
				'value' => Html::a($model->filename, ['/file/download','file'=>'program/'.$tb_program_id.'/subject/'.$tb_program_subject_id.'/document/'.$model->filename], [
								'class' => 'badge',
								'data-pjax' => '0',
							]),
			],
            'description',
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
