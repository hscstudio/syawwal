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
		<strong>Add Trainer</strong>
	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'action' => ['trainer','id'=>$trainingSchedule->id],
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
									'tb_training_class_id'=>$trainingSchedule->tb_training_class_id])."&start='+datas[3],
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
	$trainingSubjectTrainerRecommendation =\backend\models\TrainingSubjectTrainerRecommendation::find()
			->where([
				'tb_training_id'=>$trainingSchedule->trainingClassSubject->trainingClass->tb_training_id,
				'tb_program_subject_id'=>$trainingSchedule->trainingClassSubject->tb_program_subject_id,
				'status'=>1,
			])
			->groupBy('ref_trainer_type_id')
			->all();
	$ref_trainer_type_id='-1';		
	$idx=1;
	echo "<table class='table table-condensed table-striped'>";
	foreach($trainingSubjectTrainerRecommendation as $tstr){
		if($ref_trainer_type_id!=$tstr->ref_trainer_type_id){
			echo "<tr>";
			echo "<th style='width:30px;'>#</th>";
			echo "<th>";
			echo "<strong>".$tstr->trainerType->name."</strong>";
			echo "</th>";
			echo "<th style='width:50px;'>Set</th>";
			$ref_trainer_type_id=$tstr->ref_trainer_type_id;
			$idx=1;
		}
		echo "<tr>";
		echo "<td>";
		echo $idx++;
		echo "</td>";
		echo "<td>";
		echo $tstr->trainer->name.' ('.$tstr->trainer->organization.' - '.$tstr->trainer->phone.')';
		$startSearch = date('Y-m-d H:i',strtotime($trainingSchedule->startTime) + 0); // [08:00 - 09:00, 09:00 - 10:00] not excact between :)
		$finishSearch = date('Y-m-d H:i',strtotime($trainingSchedule->finishTime) - 0);
		//FIND SCHEDULE YANG BERJALAN DALAM WAKTU SAMA
		$trainingSchedule2 = \backend\models\TrainingSchedule::find()
				->where('
					((startTime between :start AND :finish)
						OR (finishTime between :start AND :finish))
					AND
					status = 1
				',
				[
					':start' => $startSearch,
					':finish' => $finishSearch,
				])
				->all();
		$available = true;
		$available_info = "available to this time";
		foreach($trainingSchedule2 as $ts2){
			$trainingScheduleTrainer = \backend\models\TrainingScheduleTrainer::find()
			->where([
				'tb_training_schedule_id' => $ts2->id,
				'tb_trainer_id' => $tstr->tb_trainer_id,
				'status' => 1,
			])
			->one();
			if(null!=$trainingScheduleTrainer){
				$available = false;
				$satker = $trainingScheduleTrainer->trainingSchedule->trainingClass->training->satker->name;
				$training = $trainingScheduleTrainer->trainingSchedule->trainingClass->training->name;
				$available_info = "This trainer have booked by ".$satker." for ".$training;
			}
		}	
		echo "</td>";
		echo "<td>";
			if($available){
				echo "<input type='checkbox' name='tb_trainer_id_array[".$tstr->tb_trainer_id."]'";
			}
			else{
				echo Html::a('-', '#', 
							[
							'class' => 'label label-warning',
							'data-pjax'=>0,
							'title'=>$available_info,
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
							]
				);
			}
		echo "</td>";
		echo "</tr>";		
	}
	echo "</table>";
	
	/*$datas = ArrayHelper::map(\backend\models\TrainingSubjectTrainerRecommendation::find()
			->select(['*',
				'idTSTR'=>'tb_training_subject_trainer_recommendation.id',
				'pengajar'=>'CONCAT(tb_trainer.name," - ",tb_trainer.organization," [",ref_trainer_type.name,"]")'])
			->where([
				'tb_training_id'=>$trainingSchedule->trainingClassSubject->trainingClass->tb_training_id,
				'tb_program_subject_id'=>$trainingSchedule->trainingClassSubject->tb_program_subject_id,
				'tb_training_subject_trainer_recommendation.status'=>1,
			])
			->joinWith('trainer')
			->joinWith('trainerType')
			->asArray()
			->all()	, 'tb_trainer_id', 'pengajar');
	echo $form->field($model, 'tb_trainer_id')->widget(Select2::classname(), [
		'data' => $datas,
		'options' => ['placeholder' => 'Choose Trainer ...'],
		'pluginOptions' => [
		'allowClear' => true
		],
	])->label('Trainer'); 
	*/
	?>
	<hr>
	
	Ket: <br>
	Data diatas adalah data pengajar yang telah direkomendasikan oleh bidang renbang diklat	dan 
	tidak sedang mengajar ditempat lain dalam waktu yang sama
    <hr>
	<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
    <?= Html::submitButton(
		'<span class="fa fa-fw fa-save"></span> Add', 
		['class' => 'btn btn-primary']) ?>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
<?php
$this->registerJs('
$("[data-toggle=\'tooltip\']").tooltip();
');
?>
