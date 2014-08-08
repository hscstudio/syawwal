<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu']=$menus;
?>
<div class="employee-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
	<!--
    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            /*
				[
					'attribute' => 'ref_satker_id',
					'value' => function ($data) {
						return $data->satker->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'ref_unit_id',
					'value' => function ($data) {
						return $data->unit->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'ref_religion_id',
					'value' => function ($data) {
						return $data->religion->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'ref_rank_class_id',
					'value' => function ($data) {
						return $data->rankClass->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'ref_graduate_id',
					'value' => function ($data) {
						return $data->graduate->name;
					}
				],
				*/
            /*
				[
					'attribute' => 'ref_sta_unit_id',
					'value' => function ($data) {
						return $data->staUnit->name;
					}
				],
				*/
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nickName',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'NickName', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'frontTitle',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'FrontTitle', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'backTitle',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'BackTitle', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nip',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Nip', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'born',
					'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Born', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Employee</h3>',
			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Employee', ['create'], ['class' => 'btn btn-success ']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			//'showFooter'=>true
		],
		'responsive'=>true,
		'hover'=>true,
		//'showPageSummary' => true
    ]); ?>

</div>
