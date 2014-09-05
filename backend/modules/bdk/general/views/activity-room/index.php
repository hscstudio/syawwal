<?php

use yii\helpers\Html;
use yii\web\JsExpression;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use hscstudio\heart\widgets\FullCalendar; //cuman contoh cari library lain :))
use yii\helpers\Url;
use hscstudio\heart\helpers\Heart;
use kartik\detail\DetailView;

$this->title = 'Activity Rooms';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="activity-room-index">
	<?php
		echo FullCalendar::widget([
			'options'=>[
				'id'=>'calendarActivityRoom',
				'header'=>[
					'left'=>'prevYear,prev,next,nextYear today',
					'center'=>'title',
					'right'=>'month,agendaWeek,agendaDay',
				],			
				'eventLimit'=>true,
				'events'=> Url::to(['events']),
				'eventClick' => new JsExpression('
					function(calEvent, jsEvent, view) {
						var modals = $("#modal-heart");
						var link = $(this);
					    modals.find(".modal-refresh").attr("href", link.attr("href"));
						modals.find(".modal-title").text(link.find(".fc-title").html());
						modals.find(".modal-body .content").html("Loading ...");
						modals.modal("show");
						
						$.ajax({
							type: "post",
							cache: false,
							url: link.prop("href"),
							data: $(".form-heart form").serializeArray(),
							success: function (data) {		
								result = data;
								modals.find(".modal-body .content").html(result);
								modals.find(".modal-body .content").css("max-height", ($(window).height() - 200) + "px");
							},
							error: function (XMLHttpRequest, textStatus, errorThrown) {
								modals.find(".modal-body .content").html("<div class=\"error\">" + XMLHttpRequest.responseText + "</div>");
							}
						});
						return false;
				    }
				'),
			],
	    ]);
	?>
</div>
<?= \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'']) ?>