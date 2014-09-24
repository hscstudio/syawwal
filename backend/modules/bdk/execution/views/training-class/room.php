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
		<strong>Set Session</strong>
	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'action' => ['room','id'=>$model->id],
		'enableAjaxValidation' => false,
		'enableClientValidation' => false,
		'options'=>[
			'onsubmit'=>"
				$.ajax({
					url: $(this).attr('action'),
					type: 'post',
					data: $(this).serialize(),
					success: function(data) {
						var datas = data.split('|');						
						if(datas[1]==1){
							$('#modal-heart').modal('hide');
							//SUCCESS
							$.pjax.reload({
								url: '".\yii\helpers\Url::to(['schedule',
									'tb_training_class_id'=>$model->tb_training_class_id])."&start='+datas[3],
								container: '#pjax-gridview-schedule', 
								timeout: 3000,
							});				
							
							//$('#trainingscheduleextsearch-starttime').val(datas[4])
							//$('#trainingscheduleextsearch-starttime-disp').val(datas[4])
						}
						else{
							alert(datas[2]);
						}
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
	$activityRoom = \backend\models\ActivityRoom::find()
		->where([
			'type'=>0,
			'activity_id'=>$model->trainingClass->tb_training_id,
			'status'=>2
		])
		->all();
	$dataRoom=[];	
	$firstAR = '';
	foreach ($activityRoom as $ar){
		$dataRoom[$ar->id] = $ar->room->name;
		if(empty($firstAR)){
			$firstAR = $ar->id;
		}
	}
	echo $form->field($model, 'tb_activity_room_id')->widget(Select2::classname(), [
		'data' => $dataRoom,
		'options' => ['placeholder' => 'Choose Room ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	])->label('Room'); ?>
	
	<hr>
	
	Ket: <br>
	Data diatas adalah data ruangan yang telah dibooking dan disetujui oleh pemilik ruangan	
    <hr>
	<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <?= Html::submitButton(
		'<span class="fa fa-fw fa-save"></span> Update', 
		['class' => 'btn btn-success']) ?>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
