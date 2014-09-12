<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel frontend\models\TrainingSearch */

$this->title = 'Trainings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-program-gridview',
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            
				[
					'format' => 'html',
					'attribute' => 'name',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],					
				],
            
				[
					'format' => 'html',
					'attribute' => 'start',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],					
				],
            
				[
					'format' => 'html',
					'attribute' => 'finish',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],					
				],
            
				[
					'format' => 'html',
					'attribute' => 'className',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data){
						return Html::a(\frontend\models\TrainingClassStudent::findOne(['tb_student_id'=>Yii::$app->user->identity->id,'tb_training_id'=>$data->id])->trainingClass->class);
					},
				],
            
				[
				 	'class' => 'kartik\grid\ActionColumn',
					'template' => '{update}',					
					'buttons' => [
						'update' => function ($url, $model) {
									$icon='<span class="glyphicon glyphicon-pencil"></span>';
									return ($model->status!=2 AND $model->status!=1)?'':Html::a($icon,\yii\helpers\Url::to('../../eregistrasi-training/default?tb_training_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode($model->id))),[
										'data-pjax'=>"0",
									]);
								},
					],	
				],

            //['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'ref_satker_id', 
					'data' => $satker,
					'value' => $ref_satker_id,
					'options' => [
						'placeholder' => 'Penyelenggara Diklat ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training/index']).'?ref_satker_id="+$(this).val(), 
								container: "#pjax-program-gridview", 
								timeout: 1,
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
		
	echo Html::endTag('div');
	?>

</div>
