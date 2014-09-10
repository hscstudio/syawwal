<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;
use kartik\widgets\AlertBlock;
use kartik\widgets\ActiveForm;
use \kartik\widgets\DatePicker;
use \kartik\widgets\TimePicker;
use \kartik\datecontrol\DateControl;
use kartik\checkbox\CheckboxX;
/* @var $searchModel backend\models\RoomSearch */

$this->title = 'Schedule : Class '.$trainingClass->class;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Classes', 'url' => ['index','tb_training_id'=>$trainingClass->tb_training_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="schedule-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="panel panel-default" id="booking-schedule">
	<div class="panel-heading">
		 <h3 class="panel-title"><i class="fa fa-fw fa-plus"></i> Add Activity</h3>
	</div>
	<div class="kv-panel-before">
	
	<?php 
	$model = new \backend\models\TrainingScheduleExtSearch();
	
	if (!isset($start) or empty($start)) {
		$start = $trainingClass->training->start;
	}
	
	$model->startDate=$start;
	$url = \yii\helpers\Url::to(['activity-lists','tb_training_class_id'=>$trainingClass->id]);
	$form = ActiveForm::begin([
		'action' => ['add-activity','tb_training_class_id'=>$trainingClass->id],
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
							//SUCCESS
							$.pjax.reload({
								url: '".\yii\helpers\Url::to(['schedule',
									'tb_training_class_id'=>$trainingClass->id])."&start='+datas[3],
								container: '#pjax-gridview-schedule', 
								timeout: 3000,
							});				
							
							$('#trainingscheduleextsearch-starttime').val(datas[4])
							$('#trainingscheduleextsearch-starttime-disp').val(datas[4])
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
	]);
	?>
	<table class="table table-striped table-condensed table-hover">
	<tr>
		<th style="width:280px;">Start Time</th>
		<th>Activity</th>
		<th style="width:100px;">Hours</th>
		<th style="width:100px;">Action</th>
	</tr>
	<tr>
		<td>
		<?php
		//echo '<label class="control-label">StartTime</label>';		
		echo "<div class='clearfix' style='width:275px;'>";
		echo "<div style='width:150px;' class='pull-left'>";
		echo $form->field($model, 'startDate')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATE,
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					'startDate'=>date('d-m-Y',strtotime($trainingClass->training->start)),
					'endDate'=>date('d-m-Y',strtotime($trainingClass->training->finish)),
				],// datepicker plugin options
				'convertFormat'=>true, // autoconvert PHP date to JS date format,				
			]
		])->label(false);
		echo "</div>";
		echo "<div style='width:100px;' class='pull-right'>";
		echo $form->field($model, 'startTime')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_TIME,
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					'showMeridian' => false,
					'minuteStep' => 1,
					'defaultTime'=> '08:00',
				],// datepicker plugin options
				'convertFormat'=>true, // autoconvert PHP date to JS date format,
			]
		])->label(false);
		echo "</div>";
		echo "</div>";
		?>
		</td>
		<td>
		<?php \yii\widgets\Pjax::begin([
			'id'=>'pjax-select-activity',
		]); ?>
		<?php
		$trainingClassSubject = \backend\models\TrainingClassSubject::find()
			->where(['tb_training_class_id'=>$trainingClass->id,'status'=>1])
			->all();
		$data=[];
		foreach($trainingClassSubject as $tcs){
			//$tcs['tb_training_class_subject_id']
			$tb_program_subject_id = $tcs->tb_program_subject_id;
			$tb_program_id = $tcs->trainingClass->training->tb_program_id;
			$tb_program_revision = $tcs->trainingClass->training->tb_program_revision;
			$programSubjectHistory = \backend\models\ProgramSubjectHistory::find()
			->where([
				'tb_program_subject_id'=>$tb_program_subject_id,
				'tb_program_id'=>$tb_program_id,
				'revision'=>$tb_program_revision,
				'status'=>1
			])
			->one();
			if(null!=$programSubjectHistory){
				$ts = \backend\models\TrainingSchedule::find()
					->select(['used_hours'=>'sum(hours)'])
					->where(['tb_training_class_subject_id'=>$tcs->id,'status'=>1])
					->groupBy('tb_training_class_subject_id')
					->asArray()
					->one();
				$available_hours = $programSubjectHistory->hours - $ts['used_hours'];
				if($available_hours>0){
					$name = $programSubjectHistory->subjectType->name.' '.$programSubjectHistory->name.' '.$available_hours.' JP';
					$data[$tcs->id]=$name;
				}
				else{
					
				}
			}
		}
		
		$data[-1] = 'Coffe Break';
		$data[-2] = 'Ishoma';
		$data[-3] = 'Others';
		
		
		// The controller action that will render the list
		$url = \yii\helpers\Url::to(['activity-lists','tb_training_class_id'=>$trainingClass->id]);
		 
		// Script to initialize the selection based on the value of the select2 element
		$initScript = "
			function (element, callback) {
				var id=$(element).val();
				if (id !== '') {
					$.ajax('".$url."', {
						dataType: 'json'
					}).done(function(data) { 
						callback(data.results);
					});
				}
			}
		";
		//$this->registerJs('$.ajax("'.$url.'", {dataType: "json"}).done(function(data) { alert(data.results.text); callback(data.results);});');
		echo $form->field($model, 'tb_training_class_subject_id')->widget(Select2::classname(), [
			'data' => $data,
			'options' => [
				'placeholder' => 'Choose Training Class Subject ...',
				'onchange'=>'
					$("#trainingscheduleextsearch-activity").prop("disabled",false);
					$("#trainingscheduleextsearch-pic").prop("disabled",false);
					$("#trainingscheduleextsearch-minutes").prop("disabled",false)
					$("#trainingscheduleextsearch-hours").prop("disabled",true);
					if($(this).val()==-1){
						$("#trainingscheduleextsearch-activity").val("Coffe Break");
						$("#trainingscheduleextsearch-pic").val("-");	
						$("#trainingscheduleextsearch-minutes").val("15");	
						$("#trainingscheduleextsearch-minutes").select();
					} 
					else if ($(this).val()==-2){
						$("#trainingscheduleextsearch-activity").val("Ishoma");
						$("#trainingscheduleextsearch-pic").val("-");		
						$("#trainingscheduleextsearch-minutes").val("60");		
						$("#trainingscheduleextsearch-minutes").select();
					}
					else if ($(this).val()==-3){
						$("#trainingscheduleextsearch-activity").val("Nama Kegiatan??");
						$("#trainingscheduleextsearch-pic").val("PIC Kegiatan");
						$("#trainingscheduleextsearch-minutes").val("30");	
						$("#trainingscheduleextsearch-activity").select();												
					}
					else{
						//$("#other-activity").slideUp("slow");
						// DISABLED
						$("#trainingscheduleextsearch-activity").val("");
						$("#trainingscheduleextsearch-pic").val("");
						$("#trainingscheduleextsearch-activity").prop("disabled",true);
						$("#trainingscheduleextsearch-pic").prop("disabled",true);
						$("#trainingscheduleextsearch-minutes").prop("disabled",true);
						
						// ENABLED
						$("#trainingscheduleextsearch-hours").prop("disabled",false);
						$("#trainingscheduleextsearch-hours").select();
					}
				',
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(false); ?>
		<?php 
		if(isset($_GET['s2I'])){
			$this->registerJs('
				$("#trainingscheduleextsearch-tb_training_class_subject_id").select2().select2("val", '.$_GET['s2I'].');
			');
		}
		?>
		
		<?php \yii\widgets\Pjax::end(); ?>
		</td>
		<td>
		<?= $form->field($model, 'hours')->textInput(['placeholder' => 'In JP',])->label(false) ?>
		</td>
		<td rowspan="2">
			<?= Html::submitButton(
			'<span class="fa fa-fw fa-plus"></span>', 
			['class' => 'btn btn-primary']) ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php
		$activityRoom = \backend\models\ActivityRoom::find()
			->where([
				'type'=>0,
				'activity_id'=>$trainingClass->tb_training_id,
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
			'options' => [
				'placeholder' => 'Choose Activity Room ...',
				'onchange'=>'
				',
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(false); 
		$this->registerCss('#s2id_trainingscheduleextsearch-tb_activity_room_id { width: 275px !important; }');
		$this->registerJs('
				$("#trainingscheduleextsearch-tb_activity_room_id").select2().select2("val", '.$firstAR.');
			');
		?>
		</td>
		<td>
		<div id="other-activity">
			<?= $form->field($model, 'activity')->textInput(['placeholder' => 'Other Activity',])->label(false) ?>			
			<?= $form->field($model, 'pic')->textInput(['placeholder' => 'PIC Activity',])->label(false) ?>
		</div>
		</td>
		<td>
			<?= $form->field($model, 'minutes')->textInput(['placeholder' => 'In Minute',])->label(false) ?>
		</td>
	</table>
	<?php ActiveForm::end(); ?>
	</div>
	</div>
	
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview-schedule',
	]); ?>
	<?php 
	if (Yii::$app->request->isAjax){	
		echo AlertBlock::widget([
			'useSessionFlash' => true,
			'type' => AlertBlock::TYPE_ALERT
		]); 
	}
	
	if (!isset($start) or empty($start)) {
		$start = $trainingClass->training->start;
	}
	$model->scheduleDate=$start;
	?>	
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'label' => 'Datetime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'200px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					$start = date('d-M-Y H:i',strtotime($model->startTime));
					$finish = date('d-M-Y H:i',strtotime($model->finishTime));
					$startDate = date('d-M-Y',strtotime($model->startTime));
					$finishDate = date('d-M-Y',strtotime($model->finishTime));
					$startTime = date('H:i',strtotime($model->startTime));
					$finishTime = date('H:i',strtotime($model->finishTime));
					
					if($start==$finish){
						return $start;
					}
					else if($startDate==$finishDate){
						return '<span class="label label-info">'.$startDate .'</span> <span class="label label-default">' .$startTime. ' s.d ' . $finishTime.'</span>';
					}
					else{
						return '<span class="label label-info">'.$start .'</span>&nbsp;<span class="label label-default"> s.d </span>&nbsp;<span class="label label-info">'.$finish.'</span>';
					}
				}
			],
			[
				'label' => 'Activity',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					if($model->tb_training_class_subject_id>0){
						$trainingClassSubject = \backend\models\TrainingClassSubject::findOne($model->tb_training_class_subject_id);
						if($trainingClassSubject!=null){
							$tb_program_subject_id = $trainingClassSubject->tb_program_subject_id;
							$tb_program_id = $trainingClassSubject->trainingClass->training->tb_program_id;
							$tb_program_revision = $trainingClassSubject->trainingClass->training->tb_program_revision;
							$programSubjectHistory = \backend\models\ProgramSubjectHistory::find()
							->where([
								'tb_program_subject_id'=>$tb_program_subject_id,
								'tb_program_id'=>$tb_program_id,
								'revision'=>$tb_program_revision,
								'status'=>1
							])
							->one();
							if(null!=$programSubjectHistory){
								$name = $programSubjectHistory->subjectType->name.' '.$programSubjectHistory->name;
								return $name;
							}
							else{
								return "Undefined??? hello??";
							}
							
						}
						else{
							return "Undefined??? hello??";
						}
					}
					else{
						return $model->activity;
					}
				}
			],
			[
				'label' => 'Hours',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'50px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					if($model->tb_training_class_subject_id>0){
						return $model->hours;
					}
					else{
						return '';
					}
				}
			],
			[
				'label' => 'PIC/Narasumber',
				'vAlign'=>'middle',
				'width'=>'200px;',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					if($model->tb_training_class_subject_id>0){
						// FIND PENGAJAR pada tb_training_schedule_trainer (id, tb_training_schedule_id, tb_trainer_id, status);
						$content = Html::a('<i class="fa fa-plus"></i> Add',['trainer','id'=>$model->id],[
							'class' => 'label label-success modal-heart',
							'data-pjax'=>0,
							'title'=>'Click to add trainer!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
						]);
						
						$trainingScheduleTrainer = \backend\models\trainingScheduleTrainer::find()
							->where([
								'tb_training_schedule_id'=>$model->id,
								'status'=>1,
							])
							->orderBy('ref_trainer_type_id ASC')
							->all();
						$ref_trainer_type_id= "-1";	
						$idx = 1;
						foreach($trainingScheduleTrainer as $trainer){
							if($ref_trainer_type_id!=$trainer->ref_trainer_type_id){
								$content .="<hr style='margin:2px 0'>";
								$content .="<strong>".$trainer->trainerType->name."</strong>";
								$content .="<hr style='margin:2px 0'>";
								$ref_trainer_type_id=$trainer->ref_trainer_type_id;
								$idx=1;
							}
							
							$content .="<div>";
							$content .="<span  class='label label-default' data-toggle='tooltip' title='".$trainer->trainer->organization." - ".$trainer->trainer->phone."'>".$idx++.". ".$trainer->trainer->name."</span> ";
							$content .=Html::a('<span class="glyphicon glyphicon-trash"></span>', 
							[
							'delete-trainer',
							'id'=>$model->id,
							'tb_trainer_id'=>$trainer->tb_trainer_id,
							], 
							[
							'class' => 'label label-danger link-post',
							'data-pjax'=>0,
							'title'=>'click to delete it!',
							//'data-confirm'=>'Are sure delete it!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
							]);	
							$content .="</div>";							
						}
					}
					else{
						$content = $model->pic;
					}
					
					
					return $content;
				}
			],
			[
				'label' => 'R',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'10px;',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					if($model->tb_activity_room_id>0){
						$ar = \backend\models\ActivityRoom::findOne($model->tb_activity_room_id);
						$room = $ar->room->name;
						$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
						if($ar->room->ref_satker_id!=$ref_satker_id){
							$room .= ' ['.$ar->room->satker->name.'] ';
						} 
						return Html::a($ar->id,['room','id'=>$model->id],[
							'class' => 'label label-warning modal-heart',
							'data-pjax'=>0,
							'title'=>$room,
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
						]);
					}
					else{
						return Html::a('-',['room','id'=>$model->id],[
							'class' => 'label label-warning modal-heart',
							'data-pjax'=>0,
							'title'=>'Click to set room!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
						]);
					}
				}
			],
			[
				'label' => 'S',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'10px;',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					if($model->tb_training_class_subject_id>0){
						return Html::a($model->session,['session','id'=>$model->id],[
							'class' => 'label label-primary modal-heart',
							'data-pjax'=>0,
							'title'=>'Click to set session!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
						]);
					}
					else{
						return Html::a('-',['session','id'=>$model->id],[
							'class' => 'label label-primary modal-heart',
							'data-pjax'=>0,
							'title'=>'Click to set session!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
						]);
					}
				}
			],
			[
				'format' => 'raw',
				'label' => 'Action',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) use($trainingClass){
					$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
					$delete = false;
					if($model->trainingClass->training->ref_satker_id==$ref_satker_id){
						$delete=true;
					}
					
					if($delete){
						return Html::a('<span class="fa fa-times"></span>', 
							[
							'delete-activity',
							'id'=>$model->id,
							'tb_training_class_id'=>$trainingClass->id,
							], 
							[
							'class' => 'label label-danger link-post',
							'data-pjax'=>0,
							'title'=>'click to delete it!',
							//'data-confirm'=>'Are sure delete it!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
							]);
					}
				}
			],
			
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Schedule</h3>',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training Class', ['index','tb_training_id'=>$trainingClass->tb_training_id], ['class' => 'btn btn-warning']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Add Activity', '#', ['class' => 'btn btn-success','onclick'=>"$('#booking-schedule').slideToggle('slow');return false;",'pjax'=>0]).' '.
				'<div class="pull-right" style="margin-right:5px; width:150px;">'.
				$form->field($model, 'scheduleDate')->widget(DateControl::classname(), [
					'type'=>DateControl::FORMAT_DATE,
					'options'=>[  // this will now become the widget options for DatePicker
						'pluginOptions'=>[
							'autoclose'=>true,
							'startDate'=>date('d-m-Y',strtotime($trainingClass->training->start)),
							'endDate'=>date('d-m-Y',strtotime($trainingClass->training->finish)),
							
						],
						'pluginEvents' => [
							//"show" => "function(e) {  # `e` here contains the extra attributes }",
							//"hide" => "function(e) {  # `e` here contains the extra attributes }",
							//"clearDate" => "function(e) {  # `e` here contains the extra attributes }",
							"changeDate" => "function(e) { 
								date = new Date(e.date);
								year = date.getFullYear(); 
								month = date.getMonth()+1; 
								day = date.getDate(); 
								var start = year+'-'+month+'-'+day;
								$.pjax.reload({
									url: '".\yii\helpers\Url::to(['schedule','tb_training_class_id'=>$trainingClass->id])."&start='+start,
									container: '#pjax-gridview-schedule', 
									timeout: 3000,
								});	
								
								var startF = $('#trainingscheduleextsearch-scheduledate-disp').val()
								$('#trainingscheduleextsearch-startdate').val(start)
								$('#trainingscheduleextsearch-startdate-disp').val(startF)
								$('#trainingscheduleextsearch-starttime-disp').val('08:00')
								
							}",
							//"changeYear" => "function(e) {  # `e` here contains the extra attributes }",
							//"changeMonth" => "function(e) {  # `e` here contains the extra attributes }",
						],
						// datepicker plugin options
						'convertFormat'=>true, // autoconvert PHP date to JS date format,
						
					]
				])->label(false).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['schedule','tb_training_class_id'=>$trainingClass->id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	<?php
	$this->registerJs('
			if($("#trainingscheduleextsearch-tb_training_class_subject_id").val()>0){
				var select2Index = $("#trainingscheduleextsearch-tb_training_class_subject_id").val();
				$.pjax.reload({
					url: "'.\yii\helpers\Url::to(['schedule',
						'tb_training_class_id'=>$trainingClass->id,
						'start'=>$start,
					]).'&s2I="+select2Index,
					container: "#pjax-select-activity", 
					timeout: 3000,
				});
				$("#trainingscheduleextsearch-hours").val(0)
			}
		
			$( "a.link-post" ).click(function() {	
				if(!confirm("Are you sure delete it??")) return false;	
				$.ajax({
					url: $(this).attr("href"),
					type: "post",
					//data: $("#form-available-room").serialize(),
					success: function(data) {
						var datas = data.split("|");	
						if(datas[1]==0){
							alert(datas[2]);
						}
						else{
							$("#trainingscheduleextsearch-starttime").val(datas[4]);
							$("#trainingscheduleextsearch-starttime-disp").val(datas[4]);
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['schedule','tb_training_class_id'=>$trainingClass->id]).'&start="+datas[3],
								container: "#pjax-gridview-schedule", 
								timeout: 3000,
							});					
						}
					},
					error:  function( jqXHR, textStatus, errorThrown ) {
						alert(jqXHR.responseText);
					}
				});	
				return false;
			});
			
			$.ajax({
				url: "'.yii\helpers\Url::to(['get-max-time','tb_training_class_id'=>$trainingClass->id,'start'=>$start]).'",
				type: "post",
				//data: $("#form-available-room").serialize(),
				success: function(data) {
					//var datas = data.split("|");	
					$("#trainingscheduleextsearch-starttime").val(data);
					$("#trainingscheduleextsearch-starttime-disp").val(data);
				},
				error:  function( jqXHR, textStatus, errorThrown ) {
					alert(jqXHR.responseText);
				}
			});	
			
			$(".modal-heart").on("click", function () {
				var $modal = $("#modal-heart");
				var $link = $(this);
				var $source = $link.attr("source")
				$modal.find(".modal-refresh").attr("href", $link.attr("href"));
				if ($link.attr("title")) {
					$modal.find(".modal-title").text($link.attr("title"));
				}
				else {
					$modal.find(".modal-title").html($link.attr("modal-title")); // warning: klo attribut title dan modal-title ada 2-2 nya
																				 // yang menang bakal yang title.
				}
				$modal.find(".modal-body .content").html("Loading ...");
				$modal.modal("show");
				
				$.ajax({
					type: "POST",
					cache: false,
					url: $link.prop("href"),
					data: $(".form-heart form").serializeArray(),
					success: function (data) {		
						if ($source) 
							result = $(data).find($source);
						else
							result = data;
						$modal.find(".modal-body .content").html(result);
						$modal.find(".modal-body .content").css("max-height", ($(window).height() - 200) + "px");
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						$modal.find(".modal-body .content").html("<div class=\"error\">" + XMLHttpRequest.responseText + "</div>");
					}
				});
				return false;
			});
			
			$("[data-toggle=\'tooltip\']").tooltip();

	');
	?>
	<?php \yii\widgets\Pjax::end(); ?>
	
	<?php 
	if (Yii::$app->request->isAjax){	
	
	}
	else{
		echo Html::beginTag('div', ['class'=>'row']);
			echo Html::beginTag('div', ['class'=>'col-md-2']);
				echo Html::beginTag('div', ['class'=>'dropdown']);
					echo Html::button('PHPExcel <span class="caret"></span></button>', 
						['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
					echo Dropdown::widget([
						'items' => [
							['label' => 'EXport XLSX', 'url' => ['php-excel?filetype=xlsx&template=yes']],
							['label' => 'EXport XLS', 'url' => ['php-excel?filetype=xls&template=yes']],
							['label' => 'Export PDF', 'url' => ['php-excel?filetype=pdf&template=no']],
						],
					]); 
				echo Html::endTag('div');
			echo Html::endTag('div');	
			echo Html::beginTag('div', ['class'=>'col-md-2']);
				echo Html::beginTag('div', ['class'=>'dropdown']);
					echo Html::button('OpenTBS <span class="caret"></span></button>', 
						['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
					echo Dropdown::widget([
						'items' => [
							['label' => 'EXport DOCX', 'url' => ['open-tbs?filetype=docx']],
							['label' => 'EXport ODT', 'url' => ['open-tbs?filetype=odt']],
							['label' => 'EXport XLSX', 'url' => ['open-tbs?filetype=xlsx']],
						],
					]); 
				echo Html::endTag('div');
			echo Html::endTag('div');	
		echo Html::endTag('div');
	}
	
	$this->registerJs('
		$("#booking-schedule").slideToggle("slow");
		$("#trainingscheduleextsearch-activity").prop("disabled",true);
		$("#trainingscheduleextsearch-pic").prop("disabled",true);
		$("#trainingscheduleextsearch-minutes").prop("disabled",true);
		$("#trainingscheduleextsearch-hours").prop("disabled",false);
	'); 			
	?>
	<?= \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'','registerAsset'=>false]) ?>
</div>
