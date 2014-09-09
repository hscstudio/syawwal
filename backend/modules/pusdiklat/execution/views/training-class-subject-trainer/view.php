<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassSubjectTrainer */
$program = $model->trainingClassSubject->trainingClass->training->tb_program_id;
$program_revision = $model->trainingClassSubject->trainingClass->training->tb_program_revision;
$programSubjects=\backend\models\ProgramSubjectHistory::find()
	->where([
		'tb_program_subject_id'=>$model->trainingClassSubject->tb_program_subject_id,'tb_program_id'=>$program,
		'revision'=>$program_revision,'status'=>1
	])
	->one();
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($model->trainingClassSubject->trainingClass->training->name), 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$model->trainingClassSubject->trainingClass->tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($model->trainingClassSubject->trainingClass->class), 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class-subject/index','tb_training_class_id'=>$model->trainingClassSubject->trainingClass->id])];
$this->params['breadcrumbs'][] = ['label' => $programSubjects->name, 'url' => ['index','tb_training_class_subject_id'=>$model->trainingClassSubject->id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-trainer-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Class Subject Trainers # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_training_class_subject_id'=>$model->trainingClassSubject->id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> DELETE',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            'id',
            'tb_training_class_subject_id',
            [
				'attribute' => 'tb_trainer_id',
				'value' => $model->trainer->name,
			],
            [
				'attribute' => 'ref_trainer_type_id',
				'value' => $model->trainerType->name,
			],
            'cost',
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
