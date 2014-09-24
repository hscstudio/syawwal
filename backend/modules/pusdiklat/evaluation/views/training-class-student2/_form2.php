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
<div class="training-class-student-certificate-form"> 
<div class="panel panel-default"> 
    <div class="panel-heading"> 
        <div class="pull-right"> 
        <?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id], 
                        ['class'=>'btn btn-xs btn-primary', 
                         'title'=>'Back to Index', 
                        ]) ?> 
        </div> 
        <i class="fa fa-fw fa-globe"></i>  
        TrainingClassStudentCertificate    </div> 
    <div style="margin:10px"> 
    <?php $form = ActiveForm::begin([]); ?> 
    <?= $form->errorSummary($model) ?>    

	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'number')->textInput(['maxlength' => 4])->label('Number (only 4 digits)')?>
				</div>
				<div class="col-md-6">
					<label>&nbsp;</label>
					<input class="form-control" type="text" disabled value="<?= $number ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
				<?= $form->field($model, 'seri')->textInput(['maxlength' => 4])->label('Seri (only 4 digits)') ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'date')->widget(\kartik\datecontrol\DateControl::classname(), [ 
			'type' => \kartik\datecontrol\DateControl::FORMAT_DATE, 
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					///'startDate'=>date('d-m-Y',strtotime($trainingClass->training->start)),
					//'endDate'=>date('d-m-Y',strtotime($trainingClass->training->finish)),
					
				],
			],
		]); ?>
		<?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [ 
			'pluginOptions' => [ 
				'onText' => 'On', 
				'offText' => 'Off', 
			] 
		]) ?>
		</div>
		<div class="form-group"> 
			<label class="col-md-2 control-label"></label> 
			<div class="col-md-10"> 
			<?= Html::submitButton( 
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update',  
				['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
			</div> 
		
		</div> 
	</div> 
    
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