<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="student-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Student	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
   <div class="row">
		<div class="col-md-6">
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
				<div class="col-md-6">
				<?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>
				</div>
				<div class="col-md-3">
				<?= $form->field($model, 'married')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?> 
				</div>
				<div class="col-md-3">
				<?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					 <?= $form->field($model, 'born')->textInput(['maxlength' => 50]) ?>
				</div>
				<div class="col-md-4">
					<?= $form->field($model, 'birthDay')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
					]); ?>
				</div>
				<div class="col-md-3">
					<?= $form->field($model, 'gender')->widget(\kartik\widgets\SwitchInput::classname(), [
						'pluginOptions' => [
							'onText' => 'Male',
							'offText' => 'Female',
						]
					]) ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<?php
					$data = ArrayHelper::map(\backend\models\Unit::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
					echo $form->field($model, 'ref_unit_id')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose Unit ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
				</div>
				<div class="col-md-6">		    
					<?= $form->field($model, 'eselon2')->textInput(['maxlength' => 100]) ?>					
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-9">
				<?= $form->field($model, 'eselon3')->textInput(['maxlength' => 100]) ?>
				</div>				
				<div class="col-md-3">
					<?php
					$data = ['1'=>'Eselon 1','2'=>'Eselon 2','3'=>'Eselon 3','4'=>'Eselon 4'];
					echo $form->field($model, 'satker')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose satker ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
				</div>
			</div>
			<?= $form->field($model, 'eselon4')->textInput(['maxlength' => 100]) ?>
			
			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'email', [
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>	
				</div>
			</div>
						
			<?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
			
			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>
				</div>
			</div>
			

			

			<?= $form->field($model, 'officeEmail')->textInput(['maxlength' => 100]) ?>			

			<?= $form->field($model, 'officeAddress')->textInput(['maxlength' => 255]) ?>

			

			
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'nip')->textInput(['maxlength' => 18]) ?>	
				</div>
				<div class="col-md-6">
					<?php
					$data = ArrayHelper::map(\backend\models\RankClass::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
					echo $form->field($model, 'ref_rank_class_id')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose RankClass ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<?php
					$data = ArrayHelper::map(\backend\models\Graduate::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
					echo $form->field($model, 'ref_graduate_id')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose Graduate ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
				</div>
				<div class="col-md-8">
					<?= $form->field($model, 'education')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="col-md-4">
					<?php
					$data = ['1'=>'Eselon 1','2'=>'Eselon 2','3'=>'Eselon 3','4'=>'Eselon 4','5'=>'Pelaksana',];
					echo $form->field($model, 'position')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose position ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>
				</div>
				<div class="col-md-8">
					<?= $form->field($model, 'positionDesc')->textInput(['maxlength' => 255]) ?>
				</div>
			</div>
			
			<div class="file-preview-thumbnails">
				<div class="file-preview-frame">
				   <img src="<?= \yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/thumb_'.$model->photo]) ?>" class="file-preview-image">
				</div>
			</div>
			
			<?= $form->field($model, 'photo')->widget(\kartik\widgets\FileInput::classname(), [
				'pluginOptions' => [
					'previewFileType' => 'any',
					'showUpload' => false,
				]
			]); ?>	
			
			<div class="clearfix"></div>
			<?php
			$data = ArrayHelper::map(\backend\models\Religion::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Religion ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>
			
			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'noSKPangkat')->textInput(['maxlength' => 255]) ?>
				</div>
				<div class="col-md-6">
				<?= $form->field($model, 'tmtSKPangkat')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>
				</div>
			</div>
			
			<div class="file-preview-frame">
			   <div class="file-preview-other">
				   <h2><i class="glyphicon glyphicon-file"></i></h2>
					   <a href='<?= \yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/'.$model->fileSKPangkat]) ?>'>Download</a>
			   </div>
			</div>
			
			<?= $form->field($model, 'fileSKPangkat')->widget(\kartik\widgets\FileInput::classname(), [
				'pluginOptions' => [
					'previewFileType' => 'any',
					'showUpload' => false,
				]
			]); ?>	
			
			<div class="clearfix"></div>
			<?= $form->field($model, 'passwordNew')->textInput(['maxlength' => 60])->label('Password, left blank if You dont want change password!') ?>
			
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
	
	<?php $this->registerCss('label{display:block !important;}'); ?>
</div>
</div>
