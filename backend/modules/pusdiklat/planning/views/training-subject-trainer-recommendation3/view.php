<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSubjectTrainerRecommendation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['training3/index']];
$this->params['breadcrumbs'][] = ['label'=>\yii\helpers\Inflector::camel2words('Subject : '.$training_name),'url'=>['training-subject3/index','tb_training_id'=>(int)$model->tb_training_id]];
$this->params['breadcrumbs'][] = ['label' => $program_subject_name, 'url' => ['index','tb_training_id'=>(int)$model->tb_training_id,'tb_program_subject_id'=>(int)$model->tb_program_subject_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-subject-trainer-recommendation-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Subject Trainer Recommendations # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_training_id'=>(int)$model->tb_training_id,'tb_program_subject_id'=>(int)$model->tb_program_subject_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> DELETE',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            'id',
            //'tb_training_id',
            [
				'attribute' => 'tb_program_subject_id',
				'label' => 'Program Subject',
				'value' => $model->programSubject->name,
			],
            //'tb_program_subject_id',
            [
				'attribute' => 'tb_trainer_id',
				'label' => 'Trainer',
				'value' => $model->trainer->name,
			],
            [
				'attribute' => 'ref_trainer_type_id',
				'label' => 'Type',
				'value' => $model->trainerType->name,
			],
            'note',
            'sort',
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
