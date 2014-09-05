<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel frontend\models\TrainingClassStudentSearch */

$this->title = 'Training Class Students';
$this->params['breadcrumbs'][] = ['label'=>'Student','url'=>['student/index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-student-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            /*
				[
					'attribute' => 'tb_training_class_id',
					'value' => function ($data) {
						return $data->trainingClass->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'tb_student_id',
					'value' => function ($data) {
						return $data->student->name;
					}
				],
				*/
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'number',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Number', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'headClass',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'HeadClass', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'activity',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Activity', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            				            				      
				[
					'format' => 'html',
					'attribute' => 'peserta_diklat',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Peserta',
					'width'=>'75px',
				],
				
				[
					'format' => 'html',
					'attribute' => 'document',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Doc',
					'width'=>'75px',
				],
				[
					'format' => 'html',
					'attribute' => 'pengajar',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					//'pageSummary' => 'Page Total',
					'width'=>'75px',
				],
				
				[
					'format' => 'html',
					'attribute' => 'evaluasi_penyelenggaraan',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'label' => 'Penyelenggaraan',
					'width'=>'75px',
				],

            	[
				 	'class' => 'kartik\grid\ActionColumn',
					'template' => '{view}',
				],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training Class Student</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			//'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Class Student', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
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
