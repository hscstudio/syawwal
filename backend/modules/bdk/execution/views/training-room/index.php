<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\TimePicker;
use backend\models\ActivityRoom;
use backend\models\Room;

$this->title = 'Request Room for '.$trainingCurrent->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => Url::to(['training/index'])];
$this->params['breadcrumbs'][] = 'Room';

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="training-room-index">

	<div class="container-fluid" style="margin:15px;">

		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="alert alert-info">
						<p>
							<i class="fa fa-fw fa-info-circle"></i>Use this tools below to select room from all satker.
							After that, just wait until General decide what to do with your request.
						</p>
					</div>
					<?php
						$form = ActiveForm::begin([
					        'id' => 'order-room-form',
					        'action' => Url::to(['training-room/save']),
					        'type' => ActiveForm::TYPE_VERTICAL
					    ]);

					    echo Html::hiddenInput('tb_training_id', $trainingCurrent->id);
					?>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo $form->field($roomModel, 'id')->label('Room List')->widget(Select2::classname(), [
						    'data' => $roomList,
						    'options' => ['placeholder' => 'Select a room ...'],
						    'pluginOptions' => [
						        'allowClear' => true
						    ],
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo '<label class="control-label">Date</label>';
						echo DatePicker::widget([
						    'name' => 'startDate',
						    'value' => date('d-M-Y', strtotime($trainingCurrent->start)),
						    'type' => DatePicker::TYPE_RANGE,
						    'name2' => 'endDate',
						    'value2' => date('d-M-Y', strtotime($trainingCurrent->finish)),
						    'pluginOptions' => [
						        'autoclose'=>true,
						        'format' => 'dd-M-yyyy'
						    ]
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo '<label class="control-label">Start Time</label>';
						echo TimePicker::widget([
						    'name' => 'startTime',
						    'pluginOptions' => [
						        'showSeconds' => true,
						        'showMeridian' => false,
						        'minuteStep' => 1,
						        'secondStep' => 5,
						    ]
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo '<label class="control-label">End Time</label>';
						echo TimePicker::widget([
						    'name' => 'endTime',
						    'pluginOptions' => [
						        'showSeconds' => true,
						        'showMeridian' => false,
						        'minuteStep' => 1,
						        'secondStep' => 5,
						    ]
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo '<label class="hidden-sm hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
						echo Html::submitButton('<i class="fa fa-fw fa-play"></i>Request Room', ['class' => 'btn btn-primary']);
						echo '</div>';
					?>
					</div>

					<div class="col-md-2">
					<?php
						echo '<div class="form-group">';
						echo '<label class="hidden-sm hidden-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
						echo Html::a('<i class="fa fa-fw fa-sign-out"></i>Done', Url::to(['training/index']), ['class' => 'btn btn-default']);
						echo '</div>';
					?>
					</div>

					<?php 

						ActiveForm::end();
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="panel panel-default">
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
								'format' => 'raw',
								'label' => 'Start Date',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('d M Y', strtotime($model->startTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'Start Time',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('H:i:s', strtotime($model->startTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'End Date',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('d M Y', strtotime($model->finishTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'End Time',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('H:i:s', strtotime($model->finishTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'Status',
								'vAlign'=>'middle',
								'hAlign' => 'center',
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
										return '<div class="label label-danger" data-toggle="tooltip" data-placement="top" title="Rejected!"><i class="fa fa-fw fa-times"></i></div>';
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
												if ($model->status == 0)
												{
													$icon='<i class="fa fa-fw fa-trash-o"></i>';
													return Html::a($icon,$url,[
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
						    'rowOptions' => function($model)
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
						    },
						    'striped' => false
						]);
					?>
				</div>
			</div>
		</div>

	</div>

</div>
