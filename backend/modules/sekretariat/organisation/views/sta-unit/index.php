<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StaUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sta Units';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu']=$menus;
?>
<div class="sta-unit-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<!--
    <p>
        <?= Html::a('Create Sta Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'induk',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Induk', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'eselon',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Eselon', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Sta Unit</h3>',
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Sta Unit', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
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
