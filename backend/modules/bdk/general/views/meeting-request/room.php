<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use kartik\checkbox\CheckboxX;
use backend\models\ActivityRoom;
use backend\models\Room;

$this->title = 'Request Room for '.$meetingCurrent->name;
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = 'Room Request';

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="training-room-index">

	<div class="container-fluid" style="margin:15px;">

		<div class="row">

			<div class="panel panel-default" id="room-finder">
				<div class="panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-fw fa-search"></i> Find Available Room
					</h3>
				</div>
				<div class="panel-body">

					<div class="col-md-4">
					<?php
						$form = ActiveForm::begin([
					        'id' => 'order-room-form',
					        'action' => Url::to(['room-search']),
					        'type' => ActiveForm::TYPE_VERTICAL,
					        'enableAjaxValidation' => false,
					        'enableClientValidation' => false,
					        'options' => [
						        'onsubmit' => "
						        	event.preventDefault();
									jQuery.ajax({
										type: 'post',
										url: jQuery(this).attr('action'),
										data: jQuery(this).serialize(),
										success: function (data) {
											jQuery(\".roomQueryResult\").html(data);
										},
									});
								"
					        ]
					    ]);

					    echo Html::hiddenInput('activity_id', $meetingCurrent->id);
						
						echo '<div class="form-group">';
						echo '<label class="control-label">Start Date</label>';
						echo DateTimePicker::widget([
						    'name' => 'startTime',
						    'value' => date('d-M-Y H:i:s', strtotime($meetingCurrent->startTime)),
						    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
						    'pluginOptions' => [
						    	'startDate' => date('d-M-Y H:i:s', strtotime($meetingCurrent->startTime)),
						    	'endDate' => date('d-M-Y H:i:s', strtotime($meetingCurrent->finishTime) + (60*60*24) - 1),
						        'autoclose'=>true,
						        'format' => 'dd-M-yyyy hh:ii:ss'
						    ]
						]);
						echo '</div>';

						echo '<div class="form-group">';
						echo '<label class="control-label">Finish Date</label>';
						echo DateTimePicker::widget([
						    'name' => 'finishTime',
						    'value' => date('d-M-Y H:i:s', strtotime($meetingCurrent->finishTime)),
						    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
						    'pluginOptions' => [
						    	'startDate' => date('d-M-Y H:i:s', strtotime($meetingCurrent->startTime)),
						    	'endDate' => date('d-M-Y H:i:s', strtotime($meetingCurrent->finishTime) + (60*60*24) - 1),
						        'autoclose'=>true,
						        'format' => 'dd-M-yyyy hh:ii:ss'
						    ]
						]);
						echo '</div>';

						echo '<div class="row">';
						echo '<div class="col-md-4">';
						echo $form->field($modelRoomKosong, 'capacity')->textInput([
								'class' => 'form-control'
							]);
						echo '</div>';

						echo '<div class="col-md-4">';
						echo $form->field($modelRoomKosong, 'hostel')->widget(CheckboxX::classname(), [
							'pluginOptions'=>['threeState'=>true,'size'=>'sm','inline'=>false, ],
						]); 
						echo '</div>';
						echo '<div class="col-md-4">';
						echo $form->field($modelRoomKosong, 'computer')->widget(CheckboxX::classname(), [
							'pluginOptions'=>['threeState'=>true,'size'=>'sm','inline'=>false, ],
						]);
						echo '</div>';
						echo '</div>';

						echo '<div class="form-group" style="margin-bottom:0; margin-top:24px;">';
						echo '<div class="btn-group">';
						echo Html::submitButton('<i class="fa fa-fw fa-search"></i>Search', [
								'class' => 'btn btn-primary',
							]);
						
						echo '</div>';
						echo '</div>';

						ActiveForm::end();
					?>
					</div>

					<div class="col-md-8">
						<div class="roomQueryResult">
							<div class="alert alert-warning"><i class="fa fa-fw fa-exclamation-circle"></i>Search room first in left panel</div>
						</div>
					</div>

				</div>

			</div>
		</div>

		<div class="row">
			<div class="panel panel-default">
				<div class="panel panel-heading">
					<h3 class="panel-title">
						<i class="fa fa-fw fa-list"></i>
						List of Requested Room
					</h3>
				</div>
				<div class="panel-body">
					<?php
						$gridColumns = [
							[
								'class' => 'kartik\grid\SerialColumn',
							],
							[
								'format' => 'raw',
								'label' => 'Room Name',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									$room = Room::find()->where(['id' => $model->tb_room_id])->one();
									return '<div class="">'.$room->name.'</div>';
								}
							],

							[
								'label' => 'Datetime',
								'vAlign'=>'middle',
								'hAlign'=>'center',
								'width'=>'250px',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'format'=>'raw',
								'value'=>function($model){
									$start = date('D, d M Y H:i',strtotime($model->startTime));
									$finish = date('D, d M Y H:i',strtotime($model->finishTime));
									$startDate = date('D, d M Y',strtotime($model->startTime));
									$finishDate = date('D, d M Y',strtotime($model->finishTime));
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
								'format' => 'raw',
								'label' => 'Status',
								'vAlign'=>'middle',
								'hAlign' => 'center',
								'width' => '80px',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									if ($model->status == 0)
									{
										return '<div class="label label-warning" data-toggle="tooltip" data-placement="top" title="Waiting for approval..."><i class="fa fa-fw fa-spinner fa-spin"></i></div>';
									}
									if ($model->status == 1)
									{
										return '<div class="label label-info" data-toggle="tooltip" data-placement="top" title="Processing..."><i class="fa fa-fw fa-play"></i></div>';
									}
									if ($model->status == 2)
									{
										return '<div class="label label-success" data-toggle="tooltip" data-placement="top" title="Approved!"><i class="fa fa-fw fa-check"></i></div>';
									}
									if ($model->status == 3)
									{
										return '<div class="label label-danger" data-toggle="tooltip" data-placement="top" title="Rejected!"><i class="fa fa-fw fa-times-circle"></i></div>';
									}
								}
							],

				            [
								'class' => 'kartik\grid\ActionColumn',
								'buttons' => [
									'view' => function ($url, $model) {
												return '';
											},
									'update' => function ($url, $model) {
												return '';
											},
									'delete' => function ($url, $model) {
												if ($model->status == 0 or $model->status == 1)
												{
													$icon='<i class="fa fa-fw fa-trash-o"></i>';
													return Html::a($icon,Url::to(['room-delete', 'id' => $model->id]),[
													'title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post",
													]);
												}
											},
								],			
							],
						];
						echo GridView::widget([
						    'dataProvider'=> $activityRoomDP,
						    'columns' => $gridColumns,
						    /*'rowOptions' => function($model)
						    {
						    	if ($model->status == 0)
						    	{
						    		return ['class' => 'warning'];
						    	}

						    	if ($model->status == 1)
						    	{
						    		return ['class' => 'info'];
						    	}
						    	
						    	if ($model->status == 2)
						    	{
						    		return ['class' => 'success'];
						    	}
						    	
						    	if ($model->status == 3)
						    	{
						    		return ['class' => 'danger'];
						    	}
						    },*/
						    'panel' => [
								'heading'=>	'<div class="btn-group">'.
									Html::a('<i class="fa fa-fw fa-arrow-circle-left"></i>Done ', Url::to(['index']), ['class' => 'btn btn-primary']).
									Html::a('<i class="fa fa-fw fa-ticket"></i> Find Room', null, [
											'class' => 'btn btn-success',
											'id' => 'room-finder-button'
										]).
									'</div>',
								'showFooter'=>false
							],
						    'striped' => false,
							'responsive'=>true,
						]);
						// dah

						// all js disni
						$this->registerJs('
								$("#room-finder").slideToggle("slow");

								$("#room-finder-button").click(function() {

									if ( $("#room-finder-button").hasClass("active") ) {
										$("#room-finder-button").removeClass("active");
										$("#room-finder").slideToggle("slow");
									}
									else {
										$("#room-finder-button").addClass("active");
										$("#room-finder").slideToggle("slow");
									}
								});
							');
					?>
				</div>
			</div>
		</div>

	</div>

</div>
