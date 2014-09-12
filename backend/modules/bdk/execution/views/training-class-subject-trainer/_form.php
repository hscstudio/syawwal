<?php

use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\models\TrainerType;
use backend\models\Trainer;

?>

<div class="training-class-subject-trainer-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> Back',[
							'index',
							'tb_training_class_subject_id'=>(int)$tb_training_class_subject_id
						],
						[
							'class'=>'btn btn-xs btn-primary',
							'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		TrainingSubjectTrainerRecommendation	</div>
	<div class="panel-body">

	    <?php $form = ActiveForm::begin([
			'type' => ActiveForm::TYPE_HORIZONTAL,
		]); ?>
		<?= $form->errorSummary($model) ?>
		
		<?php
		$data = ArrayHelper::map(Trainer::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
		echo $form->field($model, 'tb_trainer_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose Trainer ...'],
			'pluginOptions' => [
			'allowClear' => true
			],
		]); ?>

	    <?php
		$data = ArrayHelper::map(TrainerType::find()->select(['id','name'])->orderBy('id')->asArray()->all(), 'id', 'name');
		echo $form->field($model, 'ref_trainer_type_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose Trainer Type ...'],
			'pluginOptions' => [
			'allowClear' => true
			],
		]); ?>

		<?php
			echo $form->field($model, 'cost')->textInput();
		?>

	    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>

		<?php
			if ($model->isNewRecord) {
				echo $form->field($model, 'tb_training_class_subject_id')->hiddenInput(['value' => $tb_training_class_subject_id])->label('');
			}
			else {
				echo $form->field($model, 'tb_training_class_subject_id')->hiddenInput()->label('');
			}
			
		?>

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
