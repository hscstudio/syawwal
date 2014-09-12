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
use hscstudio\heart\widgets\Box;
/* @var $searchModel backend\models\RoomSearch */

$this->title = \yii\helpers\Inflector::camel2words($activity->name);
$this->params['breadcrumbs'][] = ['label' => 'Training', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="room-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="panel" id="panel-heading-dashboard" style="display:none;" >
		<a href="<?= yii\helpers\Url::to(["training/dashboard","id"=>$activity->id]) ?>" style="color:#666;padding:5px;display:block;text-align:center;background:#ddd;border-bottom: 1px solid #ddd;border-radius:4px 4px 0 0">
			<span class="badge"><i class="fa fa-arrow-circle-left"></i> Back To Dashboard</span>
		</a>
		<?php
		Box::begin([
			'type'=>'small', // ,small, solid, tiles
			'bgColor'=>'yellow', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
			'options' => [
			],
			'headerOptions' => [
				'button' => ['collapse','remove'],
				'position' => 'right', //right, left
				'color' => '', //primary, info, warning, success, danger
				'class' => '',
			],
			'header' => 'T',
			'bodyOptions' => [],
			'icon' => 'fa fa-home',
			//'link' => ['./training-class','tb_training_id'=>$training->id],
			'footerOptions' => ['class'=>'hide'],
			//'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
		]);
		?>
			<h3>Room</h3>
			<p>Room of Training</p>
		<?php
		Box::end();
		?>
	</div>
	<?php
	$this->registerJs('
		$("div#panel-heading-dashboard").slideToggle("slow");
	');
	?>
	
	<div class="panel panel-default" id="booking-room">
	<div class="panel-heading">
		 <h3 class="panel-title"><i class="fa fa-fw fa-search"></i> Find Available Room</h3>
	</div>
	<div class="kv-panel-before">
	<div class="row">
		<div class="col-md-4">
		<?php 
		$model = new \backend\models\ActivityRoomExtSearch();
		if(!isset($startDateX)) $model->startDateX=$activity->start;
		if(!isset($finishDateX)) $model->finishDateX=$activity->finish;
		if(!isset($computer)) $model->computer=0;
		if(!isset($hostel)) $model->hostel=0;
		if(!isset($capacity)) $model->capacity=20;
		$model->location=$activity->location;
		$form = ActiveForm::begin([
			'action' => ['available-room','activity_id'=>$activity_id],
			'enableAjaxValidation' => false,
			'enableClientValidation' => true,
			'options'=>[
				'id'=>'form-available-room',
				'onsubmit'=>"
					$.ajax({
						url: $(this).attr('action'),
						type: 'post',
						data: $(this).serialize(),
						success: function(data) {
							$('#available-room').html(data);
						},
						error:  function( jqXHR, textStatus, errorThrown ) {
							$('#available-room').html(jqXHR.responseText);
						}
					});	
					return false;
				",
			],
		]); 
		?>
		<?php
		echo '<label class="control-label">StartTime</label>';		
		echo "<div class='clearfix' style='width:275px;'>";
		echo "<div style='width:150px;' class='pull-left'>";
		echo $form->field($model, 'startDateX')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATE,
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					'startDate'=>date('d-m-Y',strtotime($activity->start)),
					'endDate'=>date('d-m-Y',strtotime($activity->finish)),
				],// datepicker plugin options
				'convertFormat'=>true, // autoconvert PHP date to JS date format,
				
			]
		])->label(false);
		echo "</div>";
		echo "<div style='width:100px;' class='pull-right'>";
		echo $form->field($model, 'startTimeX')->widget(DateControl::classname(), [
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
		
		<?php
		echo '<label class="control-label">FinishTime</label>';		
		echo "<div class='clearfix' style='width:275px;'>";
		echo "<div style='width:150px;' class='pull-left'>";
		echo $form->field($model, 'finishDateX')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_DATE,
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					'startDate'=>date('d-m-Y',strtotime($activity->start)),
					'endDate'=>date('d-m-Y',strtotime($activity->finish)),
				],// datepicker plugin options
				'convertFormat'=>true, // autoconvert PHP date to JS date format,
				
			]
		])->label(false);
		echo "</div>";
		echo "<div style='width:100px;' class='pull-right'>";
		echo $form->field($model, 'finishTimeX')->widget(DateControl::classname(), [
			'type'=>DateControl::FORMAT_TIME,
			'options'=>[  // this will now become the widget options for DatePicker
				'pluginOptions'=>[
					'autoclose'=>true,
					'showMeridian' => false,
					'minuteStep' => 1,
					'defaultTime'=> '17:00',
				],// datepicker plugin options
				'convertFormat'=>true, // autoconvert PHP date to JS date format,
			]
		])->label(false);
		echo "</div>";
		echo "</div>";
		?>
		
		<div class="row clearfix">
		<div class="col-md-6">
		<?= $form->field($model, 'computer')->widget(CheckboxX::classname(), [
			'pluginOptions'=>['threeState'=>false,'size'=>'sm','inline'=>true, ],
			'options'=>[
				//'value'=>1
			],
		]); ?>
		</div>
		<div class="col-md-6">
		<?= $form->field($model, 'hostel')->widget(CheckboxX::classname(), [
			'pluginOptions'=>['threeState'=>false,'size'=>'sm','inline'=>true, ]
		]); ?>
		</div>
		</div>
		
		<div class="row clearfix">
		<div class="col-md-4">
		<?= $form->field($model, 'capacity')->textInput(['maxlength' => 5]) ?>
		</div>
		<div class="col-md-8">
		<?php
		echo $form->field($model, 'location')->widget(Select2::classname(), [
			'data' => array_merge($satkers,['all'=>'ALL SATKER']),
			'options' => [
				'placeholder' => 'Choose Satker ...'
			],
			'pluginOptions' => [
				'allowClear' => true
			],
		]); 
		
		?>
		</div>
		</div>
		
		<?= Html::submitButton(
			'<span class="fa fa-fw fa-search"></span> Search', 
			['class' => 'btn btn-primary']) ?>
		</div>			
		<div class="col-md-8" id="available-room">
			
		</div>			
	</div>
	</div>
	</div>
	
	<div class="clearfix"></div>
	
	<?php ActiveForm::end(); ?>
	
	<?php 
	$this->registerCss('.sselect2-container { width: 200px !important; }');
	$this->registerJs('
			$("#form-available-room").submit();
	');
	?>
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview-room',
	]); ?>
	<?php 
	if (Yii::$app->request->isAjax){	
		echo AlertBlock::widget([
			'useSessionFlash' => true,
			'type' => AlertBlock::TYPE_ALERT
		]); 
	}
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
				'width'=>'250px',
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
				'label' => 'Room',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format'=>'raw',
				'value'=>function($model){
					$room = $model->room->name;
					$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
					if($model->room->ref_satker_id!=$ref_satker_id){
						$room .= '<br><span class="badge">'.$model->room->satker->name.'</span>';
					} 
					return $room;
				}
			],
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){									
					if ($data->status==1){
						$label='label label-info';
						$title='Process';
					}	
					else if ($data->status==2){ 
						$label='label label-success';
						$title='Approved';
					}
					else if ($data->status==3){ 
						$label='label label-danger';
						$title='Rejected';
					}
					else {
						$label='label label-warning';
						$title='Waiting';
					}
					return Html::tag('span', $title, ['class'=>$label,'title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
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
				'value' => function ($model) use ($activity){
					$ref_satker_id = (int)Yii::$app->user->identity->employee->ref_satker_id;
					$delete = false;
					if($model->room->ref_satker_id==$ref_satker_id){
						if($model->status==1) $delete=true;
					}
					else{
						if($model->status==0) $delete=true;
					}
					
					if($delete){
						return Html::a('<span class="fa fa-times"></span>', 
							[
							'unset',
							'activity_id'=>$activity->id,
							'tb_room_id'=>$model->room->id,
							], 
							[
							'class' => 'label label-danger link-post-2','data-pjax'=>0,
							'title'=>'click to set it!',
							'data-toggle'=>"tooltip",
							'data-placement'=>"top",
							]);
					}
				}
			],
			
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> List of Booked Room</h3>',
			//'type'=>'primary',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training', ['index'], ['class' => 'btn btn-warning']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Booking Room', '#', ['class' => 'btn btn-success','onclick'=>"$('#booking-room').slideToggle('slow');return false;",'pjax'=>0]),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['room','activity_id'=>$activity_id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	<?php
	$this->registerJs('
			$("#form-available-room").submit();

			$( "a.link-post-2" ).click(function() {	
				if(!confirm("Are you sure delete it??")) return false;	
				$.ajax({
					url: $(this).attr("href"),
					type: "post",
					//data: $("#form-available-room").serialize(),
					success: function(data) {
						$("#form-available-room").submit();
						$.pjax.reload({
							url: "'.\yii\helpers\Url::to(['room','activity_id'=>$activity_id]).'",
							container: "#pjax-gridview-room", 
							timeout: 3000,
						});							
					},
					error:  function( jqXHR, textStatus, errorThrown ) {
						$("#available-room").html(jqXHR.responseText);
					}
				});	
				return false;
			});
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
	
	$this->registerJs('$("#booking-room").slideToggle("slow");'); 			
	?>

</div>
