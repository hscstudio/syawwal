<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\widgets\ActiveForm;
use kartik\widgets\AlertBlock;
use kartik\widgets\Growl;
use kartik\grid\GridView;
use backend\models\TrainingSchedule;
use backend\models\TrainingClassStudentAttendance;

$this->title = 'Update Training Class Student Attendance: ';
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_ALERT
]);
?>

<div class="training-class-student-attendance-update">

    <?php

    	$columns = [
    		['class' => 'kartik\grid\SerialColumn'],

    		[
    			'label' => 'Name',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) {
					return $model->trainingStudent->student->name;
				}
			],

    		[
    			'label' => 'NIP',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) {
					return $model->trainingStudent->student->nip;
				}
			],

    		[
    			'label' => 'Unit',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) {
					return $model->trainingStudent->student->unit->shortname;
				}
			],
    	];

    	for ($i = 0; $i < count($idSchedule); $i++) {
    		$currentSchedule = $idSchedule[$i];
    		$modelTrainingSchedule = TrainingSchedule::findOne($idSchedule[$i]);
    		$columns[] = [
    			'header' => $modelTrainingSchedule->trainingClassSubject->programSubject->name.'<br>'.date('H:i', strtotime($modelTrainingSchedule->startTime)).'<br>'.$modelTrainingSchedule->hours,
				'vAlign'=>'middle',
				'format' => 'raw',
				'width' => '80px',
				'headerOptions'=>[
					'class'=>'kv-sticky-column',
				],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function($model) use ($currentSchedule, $modelTrainingSchedule) {
					$modelAttendance = TrainingClassStudentAttendance::find()
						->where([
							'tb_training_class_student_id' => $model->id,
							'tb_training_schedule_id' => $currentSchedule
						])
						->one();
					return Html::input('text', 'hours', $modelAttendance->hours, [
							'class' => 'form-control',
							'onchange' => new JsExpression('
								var maxVal = '.$modelTrainingSchedule->hours.';
								var currEle = $(this);
								if ( currEle.val() > maxVal) {
									$.growl({
										icon: "fa fa-fw fa-exclamation-circle",
										title: " <strong>Jamlat error!</strong> ",
										message: "Jamlat value should not greater than " + maxVal,
									}, {
										type: "warning",
									});
									currEle.select();
								}
								else {
					    			$.ajax({
										type: "post",
										url: "editable",
										data: {
											hours: $(this).val(),
											tb_training_schedule_id: "'.$modelAttendance->tb_training_schedule_id.'",
											tb_training_class_student_id: "'.$modelAttendance->tb_training_class_student_id.'",
										},
										success: function(data) {
											data = JSON.parse(data);
											if (data.error != "max") {
												$.growl({
													icon: "fa fa-fw fa-check-circle",
													title: " <strong>Saved!</strong> ",
													message: "New value is " + data.hours,
												}, {
													type: "success",
												});
											}
											else {
												currEle.select();
												$.growl({
													icon: "fa fa-fw fa-exclamation-circle",
													title: " <strong>Jamlat error!</strong> ",
													message: "Jamlat value should not greater than " + data.hours,
												}, {
													type: "warning",
												});
											}
										}
									})
								}
					    	')
						]);
				}
			];
    	}

    	echo GridView::widget([
    			'dataProvider' => $dataProvider,
    			'filterModel' => $searchModel,
    			'columns' => $columns,
    			'striped' => true,
    			'hover' => true,
    			'responsive' => true,
    			'panel' => [
					'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Attendance</h3>',
					'before'=>
						Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back', [
								'training-class/attendance',
								'tb_training_class_id' => $tb_training_class_id
							], ['class' => 'btn btn-warning']
						),
					'after' => '',
					'showFooter' => false
				],
				'beforeHeader'=>[
			        [
			            'columns'=>[
			                ['content'=>'Student', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
			                ['content'=>'Attendance', 'options'=>['colspan'=>count($idSchedule), 'class'=>'text-center warning']], 
			            ],
			            'options'=>['class'=>'skip-export'] // remove this row from export
			        ]
			    ],
    		]);

    ?>

</div>
