<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="program-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Program	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>

	<?php
	/*
	$data = ArrayHelper::map(\backend\models\Satker::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
	echo $form->field($model, 'ref_satker_id')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose Satker ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); 
	*/
	?>
	
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

    <?= $form->field($model, 'days')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'test')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'type')->widget(\kartik\widgets\SwitchInput::classname(), [
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

    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

	<?php if(!$model->isNewRecord){ ?>
		<?= $form->field($model, 'validationStatus')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
					
		<?= $form->field($model, 'validationNote')->textInput(['maxlength' => 255]) ?>
	<?php } ?>
	
    <div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			
		<?php if(!$model->isNewRecord){ ?>
			<?= Html::submitButton(
				'<span class="fa fa-fw fa-save"></span> '.'Update & Save as Revision', 
				['class' => 'btn btn-warning','name'=>'create_revision']) ?>
		<?php } ?>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
