<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="room-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> Back',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Room	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	
	<?php
	if($model->isNewRecord){
		$initScript = '
		//$("#trainer-ref_religion_id").select2().select2("val", 0);
		$("#room-owner").bootstrapSwitch("state", true, true);
		$("#room-status").bootstrapSwitch("state", true, true);
		$("label").attr("style","display:block;");
		';
		$this->registerJS($initScript);
	}	
	?>
	
	<?= $form->errorSummary($model) ?>
	
	<div class="row">
		<div class="col-md-8">
		<?= $form->field($model, 'code')->textInput(['maxlength' => 25]) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
		
		<?= $form->field($model, 'address')->textArea(['maxlength' => 255]) ?>
		
		<?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
			'pluginOptions' => [
				'onText' => 'On',
				'offText' => 'Off',
			]
		]) ?>
		</div>
		<div class="col-md-4">
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

		<?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
	<div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
