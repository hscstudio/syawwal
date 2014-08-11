<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Satker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="satker-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
	
    <?= $form->field($model, 'id')->dropDownList([ 'Option1', 'Option2', 'Option3', ], ['prompt' => 'Choose id']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'letterNumber')->textInput(['maxlength' => 25]) ?>

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

    <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'shortname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 500]) ?>

    <?= $form->field($model, 'email', [
					 'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
				 ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
