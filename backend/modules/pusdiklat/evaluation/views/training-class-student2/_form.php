<?php

use yii\helpers\Html; 
use kartik\widgets\ActiveForm; 
use kartik\widgets\Select2; 
use yii\helpers\ArrayHelper; 

/* @var $this yii\web\View */ 
/* @var $model backend\models\TrainingClassStudentCertificate */ 
/* @var $form yii\widgets\ActiveForm */ 
$training = \backend\models\Training::findOne($tb_training_id);
$numbers = explode('-',$training->number);
// 2014-03-00-2.2.1.0.2 to /2.3.1.2.138/07/00/2014
$number = '';
if(isset($numbers[3]) and strlen($numbers[3])>3){
	$number .= '/'.$numbers[3];
}
if(isset($numbers[1]) and strlen($numbers[1])==2){
	$number .= '/'.$numbers[1];
}
if(isset($numbers[2]) and strlen($numbers[2])==2){
	$number .= '/'.$numbers[2];
}
if(isset($numbers[0]) and strlen($numbers[0])==4){
	$number .= '/'.$numbers[0];
}
?> 
<div class="training-class-student-form"> 
<div class="panel panel-default"> 
    <div class="panel-heading"> 
        <div class="pull-right"> 
        <?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id], 
                        ['class'=>'btn btn-xs btn-primary', 
                         'title'=>'Back to Index', 
                        ]) ?> 
        </div> 
        <i class="fa fa-fw fa-globe"></i>  
        Student    </div> 
    <div style="margin:10px"> 
    <?php $form = ActiveForm::begin([
		'options'=>['enctype'=>'multipart/form-data'],
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
			
			<?= $form->field($model, 'passwordNew')->textInput(['maxlength' => 60])->label('Password, left blank if You dont want change password!') ?>
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
			
			<?= Html::submitButton( 
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update',  
				['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) 
			?> 
		</div>
	</div>
			
	
	
    
	<!--
	
	<?php
	$data = ArrayHelper::map(\backend\models\Religion::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
	echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
		'data' => $data,
		'options' => ['placeholder' => 'Choose Religion ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); ?>
	
    <?= $form->field($model, 'married')->widget(\kartik\widgets\SwitchInput::classname(), [
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

    <?= $form->field($model, 'tmtSKPangkat')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>

    <?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>

   

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'email', [
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>

    <?= $form->field($model, 'officeEmail')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'officeAddress')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'noSKPangkat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fileSKPangkat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>
     
	-->
	
    <?php ActiveForm::end(); ?> 
	
	<?php
	if($model->isNewRecord){
		$initScript = '
		//$("#trainer-ref_graduate_id").select2().select2("val", 0);
		$("#trainingclassstudentcertificate-status").bootstrapSwitch("state", true, true);
		';
		$this->registerJS($initScript);
	}	
	?>	
	<?php $this->registerCss('label{display:block !important;}'); ?>
    </div> 
</div> 
</div> 