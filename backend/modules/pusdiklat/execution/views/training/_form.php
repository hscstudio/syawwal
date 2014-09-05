<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Training	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		'enableAjaxValidation' => false,
		'enableClientValidation' => false,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
	<div class='row'>
		<div class='col-md-6'>
		<div class='row'>
			<div class='col-md-6'>
			<?= $form->field($model, 'start')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
					]); ?>
			</div>
			<div class='col-md-6'>
			<?= $form->field($model, 'finish')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
					]); ?>
			</div>
		</div>
		
		<?= $form->field($model, 'executionSK')->textInput(['maxlength' => 255]) ?>
		
		<?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
		
		<?php
		if(empty($model->location))
			$model->location = (int)Yii::$app->user->identity->employee->ref_satker_id;
			
		$data = ArrayHelper::map(\backend\models\Satker::find()
			->where('status=1')
			->asArray()
			->all(), 'id', 'name');
		echo $form->field($model, 'location')->widget(Select2::classname(), [
			'data' => array_merge($data,['-1'=>'Other']),
			'options' => ['placeholder' => 'Choose location ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); 
		?>
		
		<?php
		$data = [
				'1'=>'READY',
				'2'=>'EXECUTE',
		];
		echo $form->field($model, 'status')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose Status ...'],
			'pluginOptions' => [
				'allowClear' => true,
			],
		]); ?>
		</div>
		<div class='col-md-6'>
		
		<?= $form->field($model, 'costPlan')->textInput() ?>

		<?= $form->field($model, 'costRealisation')->textInput() ?>		

		<?= $form->field($model, 'reguler')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
					
		<?= $form->field($model, 'sourceCost')->textInput(['maxlength' => 255]) ?>				
					
		<?= $form->field($model, 'stakeholder')->textInput(['maxlength' => 255]) ?>

		
		
		
		<?php
		$initScript = '
		//$("#meeting-location").select2().select2("val", '.$model->location.');
		$("label").attr("style","display:block;");
		$("#training-reguler").bootstrapSwitch("state", true, true);		
		';
		$this->registerJS($initScript);
		?>
		
		<?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			
		</div>
	</div>	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
