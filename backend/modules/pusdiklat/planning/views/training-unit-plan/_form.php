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
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
	<div class='row'>
		<div class='col-md-6'>
			<?php
			$data = ArrayHelper::map(\backend\models\Program::find()->select(['id','name', 'num_name' => 'CONCAT(number," - ",name)'])->currentSatker()->active()->asArray()->all(), 'id', 'num_name');
			echo $form->field($model, 'tb_program_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Program ...'],
				'pluginOptions' => [
					'allowClear' => true,
				],
			]); ?>

			<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
			
			<div class='row'>
				<div class='col-md-6'>
					<?= $form->field($model, 'start')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
					]); ?>
					
					<?= $form->field($model, 'studentCount')->textInput() ?>
				</div>
				<div class='col-md-6'>
					<?= $form->field($model, 'finish')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
					]); ?>
					
					<?= $form->field($model, 'classCount')->textInput(['maxlength' => 3, 'value'=>($model->classCount>0)?$model->classCount:1]) ?>
				</div>
			</div>
			
			<?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>
			
			<?php if(!$model->isNewRecord){ ?>
				<?= $form->field($model, 'number', [
						'addon' => ['prepend' => ['content'=>'Generate Number '.\kartik\checkbox\CheckboxX::widget([
											'name'=>'generate_number','value'=>1,
											'pluginOptions'=>['threeState'=>false,'size'=>'xs']
						])]]
					])->textInput() ?>
			<?php } ?>
		</div>
		<div class='col-md-6'>
			<?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
					
			<?= $form->field($model, 'reguler')->widget(\kartik\widgets\SwitchInput::classname(), [
				'pluginOptions' => [
					'onText' => 'On',
					'offText' => 'Off',
				],
			]) ?>	
			
			<?php //$form->field($model, 'costPlan')->textInput() ?>

			<?php //$form->field($model, 'costRealisation')->textInput() ?>

			<?php //$form->field($model, 'executionSK')->textInput(['maxlength' => 255]) ?>

			<?php //$form->field($model, 'resultSK')->textInput(['maxlength' => 255]) ?>

			<?php // $form->field($model, 'sourceCost')->textInput(['maxlength' => 255]) ?>

			<?= $form->field($model, 'stakeholder')->textInput(['maxlength' => 255]) ?>
			
			<?= $form->field($model, 'note')->textArea(['maxlength' => 255]) ?>
						
			<?php if(!$model->isNewRecord){ ?>
			<div class='row'>
				<div class='col-md-6'>				
				<?php
				$data = [
						'0'=>'PLAN',
						'1'=>'READY',
						//'2'=>'EXECUTE',
						'3'=>'CANCEL'
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
				<?= $form->field($model, 'approvedStatus')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'On',
							'offText' => 'Off',
						]
					]) ?>
				</div>	
			</div>
			<?php } ?>
			
			<?php if(!$model->isNewRecord){ ?>
				<?= $form->field($model, 'approvedStatusNote')->textInput(['maxlength' => 255]) ?>		
			<?php } ?>
		</div>
	</div>
    
	    
	<div class="row">
		<div class='col-md-6'>
		
		</div>
		<div class="form-group-x col-md-6">
			<div class="btn-group">
			<?= Html::submitButton(
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
				['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			<?php 
			if(!$model->isNewRecord)
				echo Html::submitButton('<span class="fa fa-fw fa-clipboard"></span> '.'Save as Revision', ['class' => 'btn btn-warning',
		    				'name' => 'create_revision']);
			?>
			</div>	
		</div>
	<div>
	
	<div class="clearfix"></div>	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
