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
	<div class="panel-heading">
	<div class="pull-right">
		<span class="kv-buttons-1">
		<a class="btn btn-xs btn-primary" href="/github/syawwal/backend/web/pusdiklat-planning/program/index" title="Back to Index">
			<i class="fa fa-arrow-left"></i>
		</a> 
		<a class="btn btn-xs btn-danger kv-btn-delete" href="/github/syawwal/backend/web/pusdiklat-planning/program/#" title="Delete" data-method="post" data-confirm="Are you sure you want to delete this item?"><i class="glyphicon glyphicon-trash"></i></a></span> <span class="kv-buttons-2 kv-hide"><button type="button" class="btn btn-xs btn-default kv-btn-view" title="View"><span class="glyphicon glyphicon-eye-open"></span></button> <button type="submit" class="btn btn-xs btn-default kv-btn-save" title="Save"><span class="glyphicon glyphicon-floppy-disk"></span></button></span>
	</div>
	<i class="glyphicon glyphicon-globe"></i> 
	Employee
	</div>
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
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk"></span> '.'Create' : '<span class="glyphicon glyphicon-floppy-disk"></span> '.'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
    </div>
	
	</div>
    <?php ActiveForm::end(); ?>
</div>	
</div>
