<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDocument */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="program-document-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index','tb_program_id'=>$tb_program_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		ProgramDocument	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>

	<?php
	$data = [
		'KAP' => 'KAP',
		'GBPP' => 'GBPP',
		'SILABI' => 'SILABI',
	];
	echo $form->field($model, 'type')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose Type ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

	<?php
	if($model->isNewRecord){ ?>
		<?= $form->field($model, 'filename')->widget(\kartik\widgets\FileInput::classname(), [
			'pluginOptions' => [
				'previewFileType' => 'any',
				'showUpload' => false,
				]
			]); ?>
	<?php } ?>
	
    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					],
					
				]) ?>

    <?= ""//createdBy ?>

    <?= ""//modifiedBy ?>

    <?= ""//deletedBy ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

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
