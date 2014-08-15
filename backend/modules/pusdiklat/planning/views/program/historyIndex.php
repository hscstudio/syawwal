<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\ProgramSearch */

$this->title = 'Programs History';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-history-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([ 
        'dataProvider' => $dataProvider, 
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'], 
			/*[ 
				'attribute' => 'tb_program_id', 
				'value' => function ($data) { 
					return $data->program->name; 
				} 
			],*/             
			[ 
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'attribute' => 'revision', 
			],
			[ 
				'attribute' => 'number', 
			],
			[ 
				'attribute' => 'name', 
			],
            [ 
				'attribute' => 'hours', 
			], 
            [ 
				'attribute' => 'days', 
			],
            [ 
				'attribute' => 'test', 
			],    
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{delete}',
			], 
        ], 
        'panel' => [  
            'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>', 
            'before'=>Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Program', ['index'], ['class' => 'btn btn-success']), 
            'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['history-index','id'=>$_GET['id']], ['class' => 'btn btn-info']), 
            'showFooter'=>false 
        ], 
        'responsive'=>true, 
        'hover'=>true, 
    ]); ?> 
	

</div>
