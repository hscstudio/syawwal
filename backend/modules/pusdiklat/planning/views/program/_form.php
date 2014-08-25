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
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Program	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>

	<div class="row">
		<div class="col-md-6">
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
			
			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'hours')->textInput() ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'days')->textInput(['maxlength' => 3]) ?>
				</div>
			</div>		
		</div>
		<div class="col-md-6">
			
			<?php /////Merubah Bentuk type dari switch input jadi select2 dikarenakan size switch input terlalu kecil///////
				echo $form->field($model, 'type')->widget(Select2::classname(), [
					'data' => array(0=>'Lulus',1=>'Mengikuti'),
					'options' => ['placeholder' => 'Choose code ...'],
					'pluginOptions' => [
						'allowClear' => true
					],
				]);
				?>			

			<?= $form->field($model, 'note')->textArea(['maxlength' => 255]) ?>

			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'test')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]) ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							],
						]) ?>   
				</div>
			</div>
			
			<?php if(!$model->isNewRecord){ ?>
				<?= $form->field($model, 'validationStatus')->widget(\kartik\widgets\SwitchInput::classname(), [
								'pluginOptions' => [
									'onText' => 'On',
									'offText' => 'Off',
								]
							]) ?>
							
				<?= $form->field($model, 'validationNote')->textArea(['maxlength' => 255]) ?>
			<?php } ?>
		</div>
	</div>
	
	
	
    <div class="clearfix">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
