<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
	
    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Program::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'tb_program_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Program ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Satker::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_satker_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Satker ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'hours')->dropDownList([ 'Option1', 'Option2', 'Option3', ], ['prompt' => 'Choose hours']) ?>

    <?= $form->field($model, 'days')->dropDownList([ 'Option1', 'Option2', 'Option3', ], ['prompt' => 'Choose days']) ?>

    <?= $form->field($model, 'type')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'studentCount')->textInput() ?>

    <?= $form->field($model, 'classCount')->dropDownList([ 'Option1', 'Option2', 'Option3', ], ['prompt' => 'Choose classCount']) ?>

    <?= $form->field($model, 'costPlan')->textInput() ?>

    <?= $form->field($model, 'costRealisation')->textInput() ?>

    <?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'reguler')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'test')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= ""//createdBy ?>

    <?= ""//modifiedBy ?>

    <?= ""//deletedBy ?>

    <?= $form->field($model, 'start')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>

    <?= $form->field($model, 'finish')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'executionSK')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'resultSK')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sourceCost')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'stakeholder')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
