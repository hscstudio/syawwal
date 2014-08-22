<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\ProgramHistorySearch */

$this->title = \yii\helpers\Inflector::camel2words('History : '.$program_name);
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program2/index']];
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
				'attribute' => 'number',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'attribute' => 'name',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
            [
				'attribute' => 'hours',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'attribute' => 'days',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'label' => 'Doc',
				'value' => function ($data) {
					$countDoc = \backend\models\ProgramDocument::find()
								->where(
									['tb_program_id' => $data->tb_program_id,'revision' => $data->revision,]
									)
								->active()
								->count();
					if($countDoc>0){
						return Html::a($countDoc, ['program-document2/index','tb_program_id'=>$data->tb_program_id], ['class' => 'label label-primary']);
					}
					else{
						return Html::a('+', ['program-document2/index','tb_program_id'=>$data->tb_program_id], ['class' => 'label label-primary']);
					}
				}
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'label' => 'Subject',
				'value' => function ($data) {
					$countSubject = \backend\models\ProgramSubjectHistory::find()
								->where(['tb_program_id' => $data->tb_program_id,'revision' => $data->revision,])
								->count();
					if($countSubject>0){
						return Html::a($countSubject, ['program-subject-history2/index','tb_program_id'=>$data->tb_program_id,'revision'=>$data->revision], ['class' => 'label label-success']);
					}
					else{
						return Html::a('+', ['program-subject-history2/index','tb_program_id'=>$data->tb_program_id,'revision'=>$data->revision], ['class' => 'label label-success']);
					}
				}
			],
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}',				
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program History</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Program', ['program2/index'], ['class' => 'btn btn-warning']),
			//Html::a('<i class="fa fa-fw fa-plus"></i> Create Program History', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_program_id'=>(int)$tb_program_id], ['class' => 'btn btn-info']),
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
