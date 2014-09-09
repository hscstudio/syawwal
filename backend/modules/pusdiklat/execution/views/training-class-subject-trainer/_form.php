<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassSubjectTrainer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-class-subject-trainer-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index','tb_training_class_subject_id'=>$trainingClassSubject->id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		TrainingClassSubjectTrainer	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>

	<?php
	/*$data = ArrayHelper::map(\backend\models\TrainingClassSubject::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
	echo $form->field($model, 'tb_training_class_subject_id')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose TrainingClassSubject ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); */?>
	

	
	<?php
	/*
	SELECT * FROM tb_trainer
	WHERE id IN (SELECT tb_trainer_id FROM tb_training_subject_trainer_recommendation)	
	
	SELECT * tb_training_subject_trainer_recommendation
	LEFT JOIN tb_trainer 
	*/
	/*
	$data = ArrayHelper::map(\backend\models\Trainer::find()
			->select(['id','name'])
			->where([
				'id'=>\backend\models\TrainingSubjectTrainerRecommendation::find()
						->select('tb_trainer_id')
						->where([
							'tb_training_id'=>$trainingClassSubject->trainingClass->tb_training_id,
							'tb_program_subject_id'=>$trainingClassSubject->tb_program_subject_id,
							'status'=>1,
						])
			])
			->asArray()->all(), 'id', 'name');*/
	
	if($model->isNewRecord){
		$datas = ArrayHelper::map(\backend\models\TrainingSubjectTrainerRecommendation::find()
					->select(['*',
						'idTSTR'=>'tb_training_subject_trainer_recommendation.id',
						'pengajar'=>'CONCAT(tb_trainer.name," - ",tb_trainer.organization," [",ref_trainer_type.name,"]")'])
					->where([
						'tb_training_id'=>$trainingClassSubject->trainingClass->tb_training_id,
						'tb_program_subject_id'=>$trainingClassSubject->tb_program_subject_id,
						'tb_training_subject_trainer_recommendation.status'=>1,
					])
					->joinWith('trainer')
					->joinWith('trainerType')
					->asArray()
					->all()	, 'idTSTR', 'pengajar');
		echo $form->field($model, 'tb_trainer_id')->widget(Select2::classname(), [
			'data' => $datas,
			'options' => ['placeholder' => 'Choose Trainer ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); 
	}
	?>

	

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
		'pluginOptions' => [
			'onText' => 'On',
			'offText' => 'Off',
		]
	]) ?>


    <div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
