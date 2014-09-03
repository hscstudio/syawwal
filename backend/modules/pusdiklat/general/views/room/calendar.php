<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="room-view">
	
	<?= Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Room', ['index'], ['class' => 'btn btn-warning']) ?>
	<hr>
    <?php
    use hscstudio\heart\widgets\FullCalendar; 
	use yii\helpers\Url;
	
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
			'eventClick'=> new yii\web\JsExpression('function(calEvent, jsEvent, view){alert(1)}'),
			'events'=> Url::to(['events']),
		],
    ]);
	?>

</div>
