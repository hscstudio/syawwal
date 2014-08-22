<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\ProgramSubjectHistorySearch */

$this->title = \yii\helpers\Inflector::camel2words('History Subject : '.$program_history_name);
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program2/index']];
$this->params['breadcrumbs'][] = ['label'=> \yii\helpers\Inflector::camel2words('History : '.$program_name),'url'=>['program-history2/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-subject-history-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'format' => 'html',
				'attribute' => 'revision',
				'label' => 'Rev',
				'width'=>'75px',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					if($data->revision>0){
						return Html::a($data->revision.'x', '#', ['class' => 'label label-danger']);
					}
					else{
						return Html::a('-', '#', ['class' => 'label label-danger']);
					}
				}
			],
			[
				'attribute' => 'name',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'attribute' => 'hours',
				'width'=>'75px',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			
			[
				'attribute' => 'test',
				'width'=>'75px',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
        
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'width'=>'75px',
				'hAlign'=>'center',
				'label' => 'Doc',
				'value' => function ($data) {
					$model1=\backend\models\ProgramSubject::findOne($data->tb_program_subject_id);
					$countDoc = \backend\models\ProgramSubjectDocument::find()
								->where([
									'tb_program_subject_id' => $data->tb_program_subject_id,
									'revision' => $data->revision,
									])
								->active()
								->count();
					if($countDoc>0){
						return Html::a($countDoc, ['program-subject-document2/index','tb_program_id'=>$model1->tb_program_id,'tb_program_subject_id'=>$data->tb_program_subject_id], ['class' => 'label label-primary']);
					}
					else{
						return Html::a('+', ['program-subject-document2/index','tb_program_id'=>$model1->tb_program_id,'tb_program_subject_id'=>$data->tb_program_subject_id], ['class' => 'label label-primary']);
					}
				}
			],
			
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					$icon = ($data->status==1)?'<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>';
					return Html::a($icon, '#', [
						'class'=>($data->status==1)?'label label-info':'label label-warning',
					]);					
				}
			],
			
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}',
				'width'=>'75px',
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Subject History</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Program History', ['program-history2/index','tb_program_id'=>(int)$tb_program_id,], ['class' => 'btn btn-warning']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_program_id'=>(int)$tb_program_id,'revision'=>(int)$revision], ['class' => 'btn btn-info']),
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
			
		echo Html::endTag('div');
		
	echo Html::endTag('div');
	?>

</div>
