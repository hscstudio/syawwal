<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;
use yii\bootstrap\Modal;

/* @var $searchModel backend\models\MeetingSearch */

$this->title = 'Meetings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="meeting-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

			[
				'attribute' => 'name',
				'format'=>'raw',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::tag('span', $data->name, ['title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				},
			],
			
			[
				'attribute' => 'executor',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			
			[
				'attribute' => 'startTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return date('d M y H:i:s',strtotime($data->startTime));
				}
			],
			[
				'attribute' => 'finishTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return date('d M y H:i:s',strtotime($data->finishTime));
				}
			],
            
			[
				'attribute' => 'attendanceCount',
				'label' => 'Peserta',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],

			],
			[
				'attribute' => 'classCount',
				'label'=>'Class',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			
			[
				//'attribute' => 'classCount',
				'format'=>'raw',
				'label'=>'Room',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					$activityRoom = \backend\models\ActivityRoom::find()
								->where('activity_id=:activity_id',
								[
									':activity_id' => $data->id
								]);		
					if($activityRoom->count()==0){ 
						return Html::a('SET', ['room','activity_id'=>$data->id], ['class' => 'label label-warning modal-heart','data-pjax'=>0,'source'=>'']);
					}		
					else{
						return Html::a($activityRoom->count(), ['room','activity_id'=>$data->id], ['class' => 'label label-primary modal-heart','data-pjax'=>0,'source'=>'']);
					}
				}
			],

            [
			'class' => 'kartik\grid\ActionColumn',
			'template' => '{view} {update}',
			'buttons'=>[
					'view' => function ($url, $model) {
						$icon='<span class="glyphicon glyphicon-eye-open"></span>';
						return Html::a($icon,$url,[
							'data-pjax'=>"0",
							'class'=>'modal-heart',
							'source'=>'.table-responsive',
							'title'=>$model->name,
						]);
					},
				],
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Meeting</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'executor', 
					'data' => ['all'=>'ALL BIDANG',
								'GENERAL1'=>'GENERAL1','GENERAL2'=>'GENERAL2','GENERAL3'=>'GENERAL3',
								'PLANNING1'=>'PLANNING1','PLANNING2'=>'PLANNING2','PLANNING3'=>'PLANNING3',
								'EXECUTION1'=>'EXECUTION1','EXECUTION2'=>'EXECUTION2',
								'EVALUATION1'=>'EVALUATION1','EVALUATION2'=>'EVALUATION2','EVALUATION3'=>'EVALUATION3',
							],
					'value' => $executor,
					'options' => [
						'placeholder' => 'Executor ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['index']).'?executor="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','executor'=>$executor], ['class' => 'btn btn-info','data-pjax'=>0]),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	
	
	<?php echo \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']); ?>
	<?php 
	$this->registerCss('.select2-container { width: 200px !important; }');
	?>
	
	<?php \yii\widgets\Pjax::end(); ?>
	
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
				//'options' => ['multiple' => true], 
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
