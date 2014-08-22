<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\ProgramSubjectDocumentSearch */

$this->title = $program_subject_name; //'Program Subject Documents ';
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label'=> \yii\helpers\Inflector::camel2words($program_name),'url'=>['program-subject/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

?>
<div class="program-subject-document-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
		
			[
				'format' => 'html',
				'attribute' => 'name',
				'vAlign'=>'middle',
				'value' => function ($data){
					return Html::a($data->name,'#',['title'=>$data->description,'data-toggle'=>"tooltip",'data-placement'=>"left"]);
				},
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'type',
				'width'=>'75px',
				'hAlign'=>'center',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Type', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
            
			[
				'format' => 'raw',
				'attribute' => 'filename',
				'width'=>'150px',
				'hAlign'=>'center',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::a($data->filename, ['/file/download','file'=>'program/'.$data->programSubject->tb_program_id.'/subject/'.$data->tb_program_subject_id.'/document/'.$data->filename], [
						'class' => 'badge',
						'data-pjax' => '0',
					]);
				}
			],
			
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
						return Html::a('-', '#', ['class' => 'label label-danger']);
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
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Subject Document</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
			Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Program Subject', ['program-subject/index','tb_program_id'=>(int)$tb_program_id], ['class' => 'btn btn-warning','data-pjax'=>'0']).' ',
			//Html::a('<i class="fa fa-fw fa-plus"></i> Create Program Subject Document', ['create','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id], ['class' => 'btn btn-info']),
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
