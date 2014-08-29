<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Trainer */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="trainer-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Trainer	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	<?php
	if($model->isNewRecord){
		$initScript = '
		$("#trainer-ref_graduate_id").select2().select2("val", 0);
		$("#trainer-ref_rank_class_id").select2().select2("val", 0);
		$("#trainer-ref_religion_id").select2().select2("val", 0);
		$("#trainer-gender").bootstrapSwitch("state", true, true);
		$("#trainer-status").bootstrapSwitch("state", true, true);
		';
		$this->registerJS($initScript);
	}	
	?>	
	<?php $this->registerCss('label{display:block !important;}'); ?>
	<div class="row">
		<div class="col-md-3">
		<?= $form->field($model, 'frontTitle')->textInput(['maxlength' => 20]) ?>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'backTitle')->textInput(['maxlength' => 20]) ?>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-4">
		<?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'idn')->textInput(['maxlength' => 255]) ?>
		</div>
		<div class="col-md-2">
		<?= $form->field($model, 'gender')->widget(\kartik\widgets\SwitchInput::classname(), [
			'pluginOptions' => [
				'onText' => 'Male',
				'offText' => 'Female',
			]
		]) ?>
		</div>
		<div class="col-md-2">
		<?= $form->field($model, 'widyaiswara')->widget(\kartik\widgets\SwitchInput::classname(), [
			'pluginOptions' => [
				'onText' => 'On',
				'offText' => 'Off',
			]
		]) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		<?= $form->field($model, 'organization')->textInput(['maxlength' => 45]) ?>
		</div>
		<div class="col-md-4">
		<?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>
		</div>
		<div class="col-md-4">		
		<?= $form->field($model, 'email', [
			 'addon' => ['prepend' => ['content'=>'@']]
		 ]); ?>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-3">
		<?= $form->field($model, 'born')->textInput(['maxlength' => 50]) ?>   
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'birthDay')->widget(\kartik\datecontrol\DateControl::classname(), [
			'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
		]); ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
			'pluginOptions' => [
				'onText' => 'On',
				'offText' => 'Off',
			]
		]) ?>
		</div>
		<div class="col-md-3">
		<?= $form->field($model, 'married')->widget(\kartik\widgets\SwitchInput::classname(), [
			'pluginOptions' => [
				'onText' => 'On',
				'offText' => 'Off',
			]
		]) ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<?php
		$data = ArrayHelper::map(\backend\models\Graduate::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
		echo $form->field($model, 'ref_graduate_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose Graduate ...'],
			'pluginOptions' => [
				'allowClear' => true,
			],
		]); ?>	
		<?php
		$data = ArrayHelper::map(\backend\models\RankClass::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
		echo $form->field($model, 'ref_rank_class_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose RankClass ...'],
			'pluginOptions' => [
			'allowClear' => true
			],
		]); ?>	
		<?php
		$data = ArrayHelper::map(\backend\models\Religion::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
		echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => ['placeholder' => 'Choose Religion ...'],
			'pluginOptions' => [
			'allowClear' => true
			],
		]); ?>				
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'photo')->widget(\kartik\widgets\FileInput::classname(), [
		'pluginOptions' => [
			'previewFileType' => 'any',
			'showUpload' => false,
			]
		]); ?>
		<?= $form->field($model, 'document1')->widget(\kartik\widgets\FileInput::classname(), [
		'pluginOptions' => [
			'previewFileType' => 'any',
			'showUpload' => false,
			]
		]); ?>
		<?= $form->field($model, 'document2')->widget(\kartik\widgets\FileInput::classname(), [
		'pluginOptions' => [
			'previewFileType' => 'any',
			'showUpload' => false,
			]
		]); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<?= $form->field($model, 'nip')->textInput(['maxlength' => 18]) ?>
		<?= $form->field($model, 'npwp')->textInput(['maxlength' => 50]) ?>	
		<?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($model, 'officeAddress')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>
		<?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>
		<?= $form->field($model, 'officeEmail')->textInput(['maxlength' => 100]) ?>
		</div>
	</div>
    
    <?= $form->field($model, 'education')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'competency')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'bankAccount')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'educationHistory')->textInput(['maxlength' => 1000]) ?>
    <?= $form->field($model, 'trainingHistory')->textInput(['maxlength' => 1000]) ?>
    <?= $form->field($model, 'experience')->textInput(['maxlength' => 1000]) ?>
	<div class="clearfix"></div>
    <div class="form-group">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
