<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\TrainingUnitPlanSearch */

$this->title = 'Training Unit Plans';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

?>
<div class="training-unit-plan-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            	['class' => 'kartik\grid\SerialColumn'],
            
				[
					'attribute' => 'tb_training_id',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],

				[
					'attribute' => 'created',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],

				[
					'attribute' => 'spread',
					'label' => 'Setjen',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); line-height:100px; padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[0];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'Itjen',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[1];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'DJA',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[2];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'DJP',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[3];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'DJBC',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[4];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'DJPBn',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[5];
					}
				],

				[
					'attribute' => 'spread',
					'vAlign'=>'middle',
					'label' => 'DJKN',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[6];
					}
				],

				[
					'attribute' => 'spread',
					'vAlign'=>'middle',
					'label' => 'DJPK',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[7];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'DJPU',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[8];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'BKF',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[9];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'Bapepam-LK',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[10];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'BPPK',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[11];
					}
				],

				[
					'attribute' => 'spread',
					'label' => 'Lainnya',
					'vAlign'=>'middle',
					'headerOptions'=>[
						'class'=>'kv-sticky-column',
						'style' => 'transform: rotate(-90deg); padding:0px; width:10px; margin:0px;'
					],
					'contentOptions'=>['class'=>'kv-sticky-column',],
					'value' => function($data) {
						$as = explode('|', $data->spread);
						return $as[12];
					}
				],
            
				[
					'attribute' => 'total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
            
				[
					'attribute' => 'status',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Unit Plan', ['create'], ['class' => 'btn btn-success']),
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
