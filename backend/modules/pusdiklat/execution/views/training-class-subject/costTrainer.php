<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClass */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-class-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<strong>Update Cost Trainer</strong>
	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'action' => ['cost-trainer',
			'id'=>$model->trainingSchedule->tb_training_class_subject_id,
			'tb_trainer_id'=>$model->tb_trainer_id,
		],
		'enableAjaxValidation' => false,
		'enableClientValidation' => false,
		'options'=>[
			'onsubmit'=>"
				$.ajax({
					url: $(this).attr('action'),
					type: 'post',
					data: $(this).serialize(),
					success: function(data) {
						$('#modal-heart').modal('hide');
						$.pjax.reload({
							url: '".\yii\helpers\Url::to(['trainer','id'=>$model->trainingSchedule->tb_training_class_subject_id])."',
							container: '#pjax-gridview-trainer', 
							timeout: 1,
						});				
					},
					error:  function( jqXHR, textStatus, errorThrown ) {
						alert(jqXHR.responseText);
					}
				});	
				return false;
			",
		],
	]); ?>
	<?= $form->errorSummary($model) ?>
	

	<?php
	echo $form->field($model, 'cost');//->label('Trainer'); 
	?>
	<hr>
	
	Ket: <br>
	Hanya untuk praktisi
    <hr>
    <?= Html::submitButton(
		'<span class="fa fa-fw fa-save"></span> Update', 
		['class' => 'btn btn-primary']) ?>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
