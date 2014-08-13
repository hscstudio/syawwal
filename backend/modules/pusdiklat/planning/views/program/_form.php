<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-form">

<div class="panel panel-default">
	<div class="panel-heading">Employee</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?php
	$data = ArrayHelper::map(
		\backend\models\ProgramCode::find()
			->select(['id','code', 'CONCAT(name," => ",code) as name_code'])
			->orderBy(['[[id]]'=> SORT_ASC])			
			->asArray()
			->all(), 
			'code', 'name_code'
	);
	echo $form->field($model, 'number')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose code ...'],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);
	?>
	
	<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
		
    <?= $form->field($model, 'hours')->textInput() ?>

    <?= $form->field($model, 'days')->dropDownList([ 'Option1', 'Option2', 'Option3', ], ['prompt' => 'Choose days']) ?>

    <?= $form->field($model, 'test')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'validationStatus')->widget(\kartik\widgets\SwitchInput::classname(), [
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

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?php //$form->field($model, 'number')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'validationNote')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
	</div>
    <?php ActiveForm::end(); ?>
</div>	
</div>
