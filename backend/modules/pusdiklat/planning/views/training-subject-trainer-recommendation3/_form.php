<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSubjectTrainerRecommendation */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-subject-trainer-recommendation-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index','tb_training_id'=>(int)$tb_training_id,'tb_program_subject_id'=>(int)$tb_program_subject_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		TrainingSubjectTrainerRecommendation	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
	<?php
	$data = ArrayHelper::map(\backend\models\Trainer::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
	echo $form->field($model, 'tb_trainer_id')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose Trainer ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); ?>

    <?php
	$data = ArrayHelper::map(\backend\models\TrainerType::find()->select(['id','name'])->orderBy('id')->asArray()->all(), 'id', 'name');
	echo $form->field($model, 'ref_trainer_type_id')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose Trainer Type ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); ?>


    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= ""//createdBy ?>

    <?= ""//modifiedBy ?>

    <?= ""//deletedBy ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

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
