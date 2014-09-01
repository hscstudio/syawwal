<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use hscstudio\heart\widgets\FullCalendar; //cuman contoh cari library lain :))
use yii\helpers\Url;
use hscstudio\heart\helpers\Heart;

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
				'editable'=> true,
				'eventLimit'=>true,
				'events'=> Url::to(['events']),
				'eventClick' => 'js:function(calEvent, jsEvent, view) {
							        alert();
							    }',
			],
	    ]);

	?>
</div>
