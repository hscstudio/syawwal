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
		<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
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
	
    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\TrainingClassSubject::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'tb_training_class_subject_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose TrainingClassSubject ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\Trainer::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'tb_trainer_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Trainer ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\TrainerT::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_trainer_type')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose TrainerT ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= $form->field($model, 'cost')->textInput() ?>

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