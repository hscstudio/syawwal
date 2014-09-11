<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

?>

<div class="room-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-fw fa-times-circle"></i> Cancel',['index'],
						['class'=>'btn btn-xs btn-default',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Room	</div>
	<div class="panel-body">

    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_VERTICAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
	<div class="row">
		<div class="col-md-4">
		    <?= $form->field($model, 'code')->textInput(['maxlength' => 25]) ?>
		</div>
		<div class="col-md-8">
			<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2">
			<?= $form->field($model, 'owner')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
		</div>
		<div class="col-md-2">
			<?= $form->field($model, 'computer')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
		</div>
		<div class="col-md-2">
		    <?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]) ?>
		</div>
		<div class="col-md-2">
		    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]) ?>
		</div>
		<div class="col-md-4">
    		<?= $form->field($model, 'capacity')->textInput() ?>
		</div>
	</div>

    <div class="row">
	    <div class="form-group">
			<div class="col-md-12">
	        <?= Html::submitButton(
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
				['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
			</div>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
