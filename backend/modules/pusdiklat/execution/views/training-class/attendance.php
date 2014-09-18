<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\AlertBlock;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;
use kartik\checkbox\CheckboxX;
use backend\models\ActivityRoom;
use backend\models\ProgramSubjectHistory;
use backend\models\TrainingScheduleExtSearch;
use backend\models\TrainingScheduleTrainer;
use backend\models\TrainingSchedule;

$this->title = 'Schedule : Class '.$trainingClass->class;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Classes', 'url' => ['index','tb_training_id'=>$trainingClass->tb_training_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="schedule-index">
	
	<?php 
		Pjax::begin([
			'id'=>'pjax-gridview-schedule',
		]); 
	?>

	<?php 

		$model = new TrainingScheduleExtSearch;
	
		if (!isset($start) or empty($start)) {
			$start = $trainingClass->training->start;
		}
		
		$model->startDate=$start;

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
					$modelTrainingSchedule = TrainingSchedule::find()
						->where([
							'tb_training_class_id' => $model->tb_training_class_id,
							'session' => $model->session
						])
						->andWhere('tb_training_class_subject_id > 0')
						->all();

					$out = '';

					foreach ($modelTrainingSchedule as $row) {
						$start = date('d-M-Y H:i',strtotime($row->startTime));
						$finish = date('d-M-Y H:i',strtotime($row->finishTime));
						$startDate = date('d-M-Y',strtotime($row->startTime));
						$finishDate = date('d-M-Y',strtotime($row->finishTime));
						$startTime = date('H:i',strtotime($row->startTime));
						$finishTime = date('H:i',strtotime($row->finishTime));
						
						if($start==$finish){
							$out .= $start;
						}
						else if($startDate==$finishDate){
							$out .= '<span class="label label-info">'.$startDate .'</span> <span class="label label-default">' .$startTime. ' s.d ' . $finishTime.'</span><br>';
						}
						else{
							$out .= '<span class="label label-info">'.$start .
									'</span> <span class="label label-default"> s.d </span>&nbsp;<span class="label label-info">'.$finish.'</span><br>';
						}
					}

					return $out;
					
				}
			],
			[
				'label' => 'Activity',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					$modelTrainingSchedule = TrainingSchedule::find()
						->where([
							'tb_training_class_id' => $model->tb_training_class_id,
							'session' => $model->session
						])
						->andWhere('tb_training_class_subject_id > 0')
						->all();

					$out = '';

					foreach ($modelTrainingSchedule as $row) {
						$modelProgramSubjectHistory = ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $row->trainingClassSubject->tb_program_subject_id,
							'tb_program_id' => $row->trainingClassSubject->trainingClass->training->tb_program_id,
							'revision' => $row->trainingClass->training->tb_program_revision,
							'status' => 1
						])
						->one();
						$out .= $modelProgramSubjectHistory->name.'<br>';
					}

					return $out;

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
					$modelTrainingSchedule = TrainingSchedule::find()
						->where([
							'tb_training_class_id' => $model->tb_training_class_id,
							'session' => $model->session
						])
						->andWhere('tb_training_class_subject_id > 0')
						->all();

					$out = '';

					foreach ($modelTrainingSchedule as $row) {
						$out .= $row->hours.'<br>';
					}

					return $out;
					
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
					$modelTrainingSchedule = TrainingSchedule::find()
						->where([
							'tb_training_class_id' => $model->tb_training_class_id,
							'session' => $model->session
						])
						->andWhere('tb_training_class_subject_id > 0')
						->all();

					$out = '';

					foreach ($modelTrainingSchedule as $row) {
						$trainingScheduleTrainer = TrainingScheduleTrainer::find()
							->where([
								'tb_training_schedule_id' => $row->id,
								'status' => 1,
							])
							->orderBy('ref_trainer_type_id ASC')
							->all();
			
						$ref_trainer_type_id= "-1";	
						$idx = 1;
						$content = '';

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
							$content .="</div>";
							$out .= $content;
						}
					}

					return $out;

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
				'value' => function ($model) {
					$modelTrainingSchedule = TrainingSchedule::find()
						->where([
							'tb_training_class_id' => $model->tb_training_class_id,
							'session' => $model->session
						])
						->andWhere('tb_training_class_subject_id > 0')
						->all();

					$out = '';

					$idTrainingClassSubject = [];
					$idSchedule = [];

					foreach ($modelTrainingSchedule as $row) {
						$idTrainingClassSubject[] = $row->tb_training_class_subject_id;
						$idSchedule[] = $row->id;
					}

					$idTrainingClassSubject = implode('_', $idTrainingClassSubject);
					$idSchedule = implode('_', $idSchedule);

					$out .= '<div class="btn-group" style="margin-bottom:3px;">';
					$out .= Html::a('<i class="fa fa-fw fa-mortar-board"></i>', Url::to([
							'training-class-student-attendance/update', 
							'for' => 'trainer',
							'idSubjects' => $idTrainingClassSubject,
							'tb_training_schedule_id' => $idSchedule
						]), ['class' => 'btn btn-default btn-xs']
					).' '.
					Html::a('<i class="fa fa-fw fa-child"></i>', Url::to([
							'training-class-student-attendance/update', 
							'for' => 'student',
							'idSubjects' => $idTrainingClassSubject,
							'tb_training_schedule_id' => $idSchedule
						]), ['class' => 'btn btn-default btn-xs']
					);
					$out .= '</div>';

					return $out;
				}
			],
			
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Schedule</h3>',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training Class', [
					'index',
					'tb_training_id'=>$trainingClass->tb_training_id
				], ['class' => 'btn btn-warning'])
				/*'<div class="pull-right" style="margin-right:5px; width:150px;">'.
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
				'</div>'*/,
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
