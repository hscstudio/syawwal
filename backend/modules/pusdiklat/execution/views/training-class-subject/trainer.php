<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassSubject */

$program = $model->trainingClass->training->tb_program_id;
$program_revision = $model->trainingClass->training->tb_program_revision;
$programSubjects=\backend\models\ProgramSubjectHistory::find()
	->where([
		'tb_program_subject_id'=>$model->tb_program_subject_id,'tb_program_id'=>$program,
		'revision'=>$program_revision,'status'=>1
	])
	->one();
$this->title = 'Trainer of Subject '.$programSubjects->name;;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($model->trainingClass->training->name), 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$model->trainingClass->tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => $model->trainingClass->class, 'url' => ['index','tb_training_class_id'=>$model->tb_training_class_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-trainer">
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview-trainer',
	]); ?>
	<?= GridView::widget([
		'dataProvider' => $provider,  
		'columns' =>[
			['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'tb_trainer_type_id',
				'label'=> 'Type',
				'format' => 'html',
				'value' => function ($data){
					return $data->trainerType->name;
				},
				
			],
			[
				'attribute' => 'tb_trainer_id',
				'label'=> 'Trainer',
				'format' => 'html',
				'value' => function ($data){
					return $data->trainer->name.' ['.$data->trainer->organization.'-'.$data->trainer->phone.']';
				},
				
			],
			[
				'attribute' => 'cost',
				'label'=> 'Cost (JP)',
				'format' => 'html',
				'value' => function ($data) use ($model){
					return Html::a(number_format($data->cost,0),
						['cost-trainer','id'=>$model->id,'tb_trainer_id'=>$data->tb_trainer_id],
						['class'=>'modal-heart','data-pjax'=>0]);
				},
				
			],						
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training Class', \yii\helpers\Url::to(['index','tb_training_class_id'=>$model->trainingClass->id]), ['class' => 'btn btn-warning']).' ',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['trainer','id'=>$model->id,'tb_training_class_id'=>$model->trainingClass->id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
	]); ?>
	
	<?= \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'','registerAsset'=>true]) ?>
	
	<?php \yii\widgets\Pjax::end(); ?>
	
</div>
