<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use backend\models\ActivityRoom;
use backend\models\TrainingClass;
use backend\models\TrainingClassStudent;

$this->title = 'Training';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-index">

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            	['class' => 'kartik\grid\SerialColumn'],
                        
				[
					'class' => 'kartik\grid\EditableColumn',
					'format' => 'raw',
					'attribute' => 'name',
					'vAlign'=>'middle',
					'hAlign' => 'left',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]],
					'value' => function ($data) {
						return '<div data-toggle="tooltip" data-placement="top" title="'.$data->note.'">'.$data->name.'</div>';
					}
				],
            
				[
					'attribute' => 'start',
					'vAlign'=>'middle',
					'width'=>'100px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						return date('d M Y', strtotime($data->start));
					}
				],
            
				[
					'attribute' => 'finish',
					'vAlign'=>'middle',
					'width'=>'100px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						return date('d M Y', strtotime($data->finish));
					}
				],
            
				[
					'attribute' => 'classCount',
					'vAlign'=>'middle',
					'hAlign' => 'center',
					'label' => 'Class',
					'width'=>'80px',
					'format' => 'raw',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>[
						'class'=>'kv-sticky-column',
					],
					'value' => function ($data)
					{
						$fOut = '<div class="btn-group">';

						if ($data->classCount == null) {
							$fOut .= Html::a(0, null, [
								'class' => 'btn btn-default btn-xs',
								'data-container' => "body",
								'data-toggle' => "tooltip",
								'data-placement' => "top",
								'data-original-title' => "Rencana jumlah kelas",
								'data-pjax' => "0"
							]);
						}
						else {
							$fOut .= Html::a($data->classCount, null, [
								'class' => 'btn btn-default btn-xs',
								'data-container' => "body",
								'data-toggle' => "tooltip",
								'data-placement' => "top",
								'data-original-title' => "Rencana jumlah kelas",
								'data-pjax' => "0"
							]);
						}

						$classCount = TrainingClass::find()->where(['tb_training_id' => $data->id])->count();

						if ($classCount != 0) {
							$fOut .= '<a class="btn btn-info btn-xs" data-pjax="0" data-container="body" data-toggle="tooltip" data-placement="top" data-original-title="Kelas yang telah dibuat" href="'.Url::to(['training-class/index', 'trainingId' => $data->id]).'">
										'.$classCount.'
										</a>';
						}
						else {
							$fOut .= '<a class="btn btn-info btn-xs" data-pjax="0" data-container="body" data-toggle="tooltip" data-placement="top" data-original-title="Kelas yang telah dibuat" href="'.Url::to(['training-class/index', 'trainingId' => $data->id]).'">
										<i class="fa fa-fw fa-plus-circle"></i>
										</a>';
						}
						$fOut .= '</div>';

						return $fOut;
					}
				],
            
				[
					'label' => 'Student',
					'attribute' => 'studentCount',
					'vAlign'=>'middle',
					'format' => 'raw',
					'hAlign'=>'center',
					'width'=>'80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						$fOut = '<div class="btn-group">';

						if ($data->studentCount == null) {
							$fOut .= Html::a(0, null, [
								'class' => 'btn btn-default btn-xs',
								'data-container' => "body",
								'data-toggle' => "tooltip",
								'data-placement' => "top",
								'data-original-title' => "Rencana jumlah peserta",
								'data-pjax' => "0"
							]);
						}
						else {
							$fOut .= Html::a($data->studentCount, null, [
								'class' => 'btn btn-default btn-xs',
								'data-container' => "body",
								'data-toggle' => "tooltip",
								'data-placement' => "top",
								'data-original-title' => "Rencana jumlah peserta",
								'data-pjax' => "0"
							]);
						}

						// masih belum final, tar aja

						$studentCount = TrainingClassStudent::find()->where(['tb_training_class_id' => $data->id])->count();

						if ($studentCount != 0) {
							$fOut .= '<a class="btn btn-info btn-xs" data-pjax="0" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Peserta yang telah diinput" href="'.Url::to(['training-student/index', 'trainingId' => $data->id]).'">
										'.$studentCount.'
										</a>';
						}
						else {
							$fOut .= '<a class="btn btn-info btn-xs" data-pjax="0" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Peserta yang telah diinput" href="'.Url::to(['training-student/index', 'trainingId' => $data->id]).'">
										<i class="fa fa-fw fa-plus-circle"></i>
										</a>';
						}
						$fOut .= '</div>';

						return $fOut;
					}
				],

				[
					'format' => 'raw',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'width'=>'80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'label' => 'Room',
					'value' => function ($data)
					{
						$fOut = '';

						// Room management
						$roomCount = ActivityRoom::find()->where(['type' => 0, 'activity_id' => $data->id])->count();

						$roomWaitingCount = ActivityRoom::find()->where([
											'type' => 0, 
											'activity_id' => $data->id, 
											'status' => 0
										])->count();
						$roomProcessCount = ActivityRoom::find()->where([
											'type' => 0, 
											'activity_id' => $data->id, 
											'status' => 1
										])->count();
						$roomApprovedCount = ActivityRoom::find()->where([
											'type' => 0, 
											'activity_id' => $data->id, 
											'status' => 2
										])->count();
						$roomRejectedCount = ActivityRoom::find()->where([
											'type' => 0, 
											'activity_id' => $data->id, 
											'status' => 3
										])->count();

						/* 
						$fOut = '<div class="col-md-3">
									<div class="label label-warning" data-toggle="tooltip" data-placement="top" title="Waiting...">
									'.$roomWaitingCount.'
									</div>
								</div>';
						$fOut .= '<div class="col-md-3">
									<div class="label label-info" data-toggle="tooltip" data-placement="top" title="Process...">
									'.$roomProcessCount.'
									</div>
								</div>';
						$fOut .= '<div class="col-md-3">
									<div class="label label-success" data-toggle="tooltip" data-placement="top" title="Approved!">
									'.$roomApprovedCount.'
									</div>
								</div>';
						$fOut .= '<div class="col-md-3">
									<div class="label label-danger" data-toggle="tooltip" data-placement="top" title="Rejected!">
									'.$roomRejectedCount.'
									</div>
								</div>';
						*/

						// room management end

						$fOut .= '<div class="btn-group">';

						if ($roomCount != 0) {
							$fOut .= '<a class="label label-info" data-pjax="0" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Requested ('.$roomProcessCount.'), Approved ('.$roomApprovedCount.'), Rejected ('.$roomRejectedCount.')" href="'.Url::to(['training-room/index', 'tb_training_id' => $data->id]).'">'.$roomCount.'</a>';
						}
						else {
							$fOut .= '<a class="label label-default" data-pjax="0" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="No room requested. Click to enter" href="'.Url::to(['training-room/index', 'tb_training_id' => $data->id]).'">'.$roomCount.'</a>';
						}

						$fOut .= '</div>';

						return $fOut;
					}
				],

				[
					'format' => 'html',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Revision',
					'width'=>'80px',
					'value' => function ($data) {
						$countRevision = \backend\models\TrainingHistory::find()
									->where(['tb_training_id' => $data->id,])
									->count()-1;
						if($countRevision>0){
							return Html::a($countRevision.'x', ['training-history/','tb_training_id'=>$data->id], ['class' => 'label label-danger']);
						}
						else{
							return '<span class="label label-danger">0</span>';
						}
					}
				],
				[
					'format' => 'raw',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Status',
					'width'=>'80px',
					'value' => function ($data)
					{
						if ($data->status==1)
						{
							$icon='<span class="fa fa-fw fa-check-square-o"></span>';
							$label='label label-info';
							$title='Ready';
						}	
						else if ($data->status==2)
						{ 
							$icon='<span class="fa fa-fw fa-refresh"></span>';
							$label='label label-success';
							$title='Execute';
						}
						else if ($data->status==3)
						{
							$icon='<span class="fa fa-fw fa-trash-o"></span>';
							$label='label label-danger';
							$title='Cancel';
						}
						else
						{
							$icon='<span class="fa fa-fw fa-fire"></span>';
							$label='label label-warning';
							$title='Plan';
						}
						return Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top"]);
						}
				],

	            [
	            	'class' => 'kartik\grid\ActionColumn',
					'buttons' => [
						'view' => function ($url, $model) {
							$icon='<span class="glyphicon glyphicon-eye-open"></span>';
							return Html::a($icon,$url,[
								'class'=>'modal-heart',
								'data-pjax'=>"0",
								'source'=>'.table-responsive',
								'title'=> 'See Detail',
								'modal-title' => '<i class="fa fa-fw fa-eye"></i> Detail: '.$model->name
							]);
						},
						'update' => function ($url, $model) {
							$icon='<span class="glyphicon glyphicon-pencil"></span>';
							return Html::a($icon,$url,[
								'class'=>'modal-heart',
								'data-pjax'=>"0",
								'modal-title' => '<i class="fa fa-fw fa-pencil-square-o"></i> Update: '.$model->name
							]);
						},
					],
	            ],
	        ],
			'panel' => [
				'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training List</h3>',
				'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training', ['create'], [
						'class' => 'btn btn-success modal-heart',
						'data-pjax' => '0',
						'modal-title' => '<i class="fa fa-fw fa-stack-overflow"></i> Create New Training'
					]). ' '.
					'<div class="pull-right" style="margin-right:5px;">'.
					Select2::widget([
						'name' => 'year', 
						'data' => $year_training,
						'value' => $year,
						'options' => [
							'placeholder' => 'Year ...', 
							'class'=>'form-control', 
							'onchange'=>'
								$.pjax.reload({
									url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training/index']).'?status='.$status.'&year="+$(this).val(), 
									container: "#pjax-gridview", 
									timeout: 1,
								});
							',	
						],
					]).
					'</div>'.
					'<div class="pull-right" style="margin-right:5px;">'.
					Select2::widget([
						'name' => 'status', 
						'data' => ['all'=>'All','1'=>'Ready','2'=>'Execute','3'=>'Cancel'],
						'value' => $status,
						'options' => [
							'placeholder' => 'Status ...', 
							'class'=>'form-control', 
							'onchange'=>'
								$.pjax.reload({
									url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training/index']).'?year='.$year.'&status="+$(this).val(), 
									container: "#pjax-gridview", 
									timeout: 1000,
								});
							',	
						],
					]).
					'</div>',
				'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
				'showFooter'=>false
			],
			'responsive'=>true,
			'hover'=>true,
	    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>


	<?php
		echo \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']);
	?>

	<?php 	
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
		
		echo Html::beginTag('div', ['class'=>'col-md-8']);
			$form = \yii\bootstrap\ActiveForm::begin([
				'options'=>['enctype'=>'multipart/form-data'],
				'action'=>['import'],
			]);
			echo \kartik\widgets\FileInput::widget([
				'name' => 'importFile', 
				'pluginOptions' => [
					'previewFileType' => 'any',
					'uploadLabel'=>"Import Excel",
				]
			]);
			\yii\bootstrap\ActiveForm::end();
		echo Html::endTag('div');
		
	echo Html::endTag('div');
	?>

</div>
