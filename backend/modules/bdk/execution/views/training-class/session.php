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
		'action' => ['session','id'=>$model->id],
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
	/* $data = ArrayHelper::map(\backend\models\Training::find()->select(['id','name'])->asArray()->all(), 'id', 'name');*/
	echo $form->field($model, 'session')->widget(Select2::classname(), [
		'data' => ['','1'=>'Session I','2'=>'Session II','3'=>'Session III','4'=>'Session IV','5'=>'Session V'],
		'options' => ['placeholder' => 'Choose Session ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	]); ?>
	
	<hr>
	
	Ket: <br>
	Sesi / session menunjukkan waktu absensi peserta, normalnya satu hari ada 4 sesi untuk diklat tanpa asrama 
	atau 5 sesi untuk diklat yang diasramakan. Sebagai gambaran, sesi 1 adalah waktu antara awal waktu hingga coffe break pertama,
	kira-kira pukul 08:00 - 10:00, sedangkan sesi 5 adalah sesi malam yaitu kira-kira pukul 19:00 - 21:00. Sesuaikan dengan kebutuhan Anda.
	
    <hr>
	<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <?= Html::submitButton(
		'<span class="fa fa-fw fa-save"></span> Update', 
		['class' => 'btn btn-success']) ?>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
