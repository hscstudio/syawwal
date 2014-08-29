<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

$this->title = 'Training Unit Plans';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

?>
<div class="training-unit-plan-index">
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
	
	<?php
	$grid_columns[] = ['class' => 'kartik\grid\SerialColumn'];
	$grid_columns[] = [
				'attribute' => 'name',
				'format'=>'raw',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column','style'=>'height:100px;'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::tag('span', $data->name, ['title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']).
					'<br><span class="label label-default">'.date('d M y',strtotime($data->start)).' s.d. '.date('d M y',strtotime($data->finish)).'</span>';
				},
			];
			
	$units = \backend\models\Unit::find()->select(['id','shortname'])->where('id>:id',[':id'=>0])->all();
	$idx=0;
	foreach($units as $unit){
		$grid_columns[]=[
			'format'=>'raw',
			'attribute' => 'StudentCount.'.$idx,
			'width' => '40px',
			//'vAlign'=>'middle',
			//'hAlign'=>'center',
			'headerOptions'=>['class'=>'kv-sticky-column'],
			'header' => '<div class="rotate" style="width:30px;">'.$unit->shortname.'</div>',
			'value' => function ($data) use ($idx) {
				if (!empty($data->trainingUnitPlans->studentCount[$idx]))
				{
					return '<div class="label alert-success">'.$data->trainingUnitPlans->studentCount[$idx].'</div>';
				}
				else
				{
					return '<div class="label alert-success">-</div>';
				}
			}
		];
		$idx++;
	}
	
    $grid_columns[] = [
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) use ($year){				
					
					if ($data->status==1){
						$icon='<span class="glyphicon glyphicon-check"></span>';
						$label='label label-info';
						$title='READY';
					}	
					else if ($data->status==2){ 
						$icon='<span class="glyphicon glyphicon-refresh"></span>';
						$label='label label-success';
						$title='EXECUTE';
					}
					else if ($data->status==3){ 
						$icon='<span class="glyphicon glyphicon-trash"></span>';
						$label='label label-danger';
						$title='CANCEL';
					}
					else {
						$icon='<span class="glyphicon glyphicon-fire"></span>';
						$label='label label-warning';
						$title='PLAN';
					}
					return Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				}
			];
			
    $grid_columns[] = [
				'class' => 'kartik\grid\ActionColumn',
				'buttons' => [
					'update' => function ($url, $model) {
								$icon='<span class="glyphicon glyphicon-pencil"></span>';
								return ($model->status==2)?'':Html::a($icon,$url,[
									'data-pjax'=>"0",
								]);
							},
					'delete' => function ($url, $model) {
								$icon='<span class="glyphicon glyphicon-trash"></span>';
								return '';
							},
				],
			];
	
	?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $grid_columns,
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
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
					'data' => ['all'=>'All','0'=>'Plan','1'=>'Ready','2'=>'Execute','3'=>'Cancel'],
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
