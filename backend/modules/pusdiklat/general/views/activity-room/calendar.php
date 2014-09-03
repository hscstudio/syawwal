<?php

use yii\helpers\Html;
use kartik\widgets\Select2;
use hscstudio\heart\widgets\FullCalendar; 
use yii\helpers\Url;
	
/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = $room->name;
$this->params['breadcrumbs'][] = ['label'=>'Room','url'=>['room/index']];
$this->params['breadcrumbs'][] = ['label' => 'Activity Room', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="room-view">
	
	<?= Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Room', ['room/index'], ['class' => 'btn btn-warning']) ?>
	<?= Html::a('<i class="fa fa-fw fa-repeat"></i> Index', ['index','tb_room_id'=>$tb_room_id], ['class' => 'btn btn-info']) ?>
	<?= '<div class="pull-right" style="margin-right:5px;">'.
		Select2::widget([
			'name' => 'status', 
			'data' => ['all'=>'All','0'=>'Waiting','1'=>'Approved','2'=>'Rejected'],
			'value' => $status,
			'options' => [
				'placeholder' => 'Status ...', 
				'class'=>'form-control', 
				'onchange'=>'
					$.pjax.reload({
						url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/activity-room/calendar']).'?tb_room_id='.$tb_room_id.'&status="+$(this).val(), 
						container: "#pjax-gridview", 
						timeout: 1000,
					});
				',	
			],
		]).
		'</div>';
	?>				
	<hr>
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
    <?php	
	echo FullCalendar::widget([
		'options'=>[
			'id'=>'calendar',
			'header'=>[
				'left'=>'prevYear,prev,next,nextYear today',
				'center'=>'title',
				'right'=>'month,agendaWeek,agendaDay',
			],			
			'editable'=> false,
			'eventLimit'=>true, // allow "more" link when too many events
			'eventClick'=> new yii\web\JsExpression('function(calEvent, jsEvent, view){
				var $modal = $("#modal-heart");
				var $link = $(this);
				var $source = ".table-responsive";
				$modal.find(".modal-refresh").attr("href", $link.attr("href"));
				$modal.find(".modal-title").text("View");
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
						$modal.find(".modal-body .content").html("<div class=\'error\'>" + XMLHttpRequest.responseText + "</div>");
					}
				});
				return false;
			}'),
			'events'=> Url::to(['events','tb_room_id'=>$tb_room_id,'status'=>$status]),
		],
    ]);
	?>
	<?php \yii\widgets\Pjax::end(); ?>
	
	<?= \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']); ?>
</div>
