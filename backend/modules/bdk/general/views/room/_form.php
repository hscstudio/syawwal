<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
	
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

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'owner')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'computer')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
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

    <?= $form->field($model, 'code')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
