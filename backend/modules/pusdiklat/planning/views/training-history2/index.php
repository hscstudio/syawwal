<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\TrainingHistorySearch */

$this->title = \yii\helpers\Inflector::camel2words('History : '.$training_name);
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-history-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'revision',
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Rev',
				'width'=>'75px',
				'value' => function ($data) {
					if($data->revision>0){
						return Html::a($data->revision.'x', '#', ['class' => 'label label-danger']);
					}
					else{
						return '-';
					}
				}
			],		
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
				'attribute' => 'start',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return date('d M y',strtotime($data->start));
				}
			],
		
			[
				'class' => 'kartik\grid\DataColumn',
				'attribute' => 'finish',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return date('d M y',strtotime($data->finish));
				}
			],
       
            
			[
				'class' => 'kartik\grid\DataColumn',
				'attribute' => 'studentCount',
				'label'=> 'Student',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			
			
			
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){				
					
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
			],
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}',
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',			
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training', ['training2/index'], ['class' => 'btn btn-warning']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_training_id'=>$tb_training_id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
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
		
		
		
	echo Html::endTag('div');
	?>

</div>
