<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\ProgramSearch */

$this->title = 'Programs';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-index">

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
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'number',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Number', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
            
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'name',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
            
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'hours',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Hours', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'days',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Days', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Document',
				'value' => function ($data) {
					$countSubject = \backend\models\ProgramDocument::find()
								->where(['tb_program_id' => $data->id,])
								->active()
								->count();
					if($countSubject>0){
						return Html::a($countSubject, ['program-document/index','tb_program_id'=>$data->id], ['class' => 'badge']);
					}
					else{
						return Html::a('+', ['program-document/index','tb_program_id'=>$data->id], ['class' => 'badge']);
					}
				}
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Revision',
				'value' => function ($data) {
					$countRevision = \backend\models\ProgramHistory::find()
								->where(['tb_program_id' => $data->id,])
								->count()-1;
					if($countRevision>0){
						return Html::a($countRevision.'x', ['program-history/index','tb_program_id'=>$data->id], ['class' => 'badge']);
					}
					else{
						return '-';
					}
				}
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Subject',
				'value' => function ($data) {
					$countSubject = \backend\models\ProgramSubject::find()
								->where(['tb_program_id' => $data->id,])
								->active()
								->count();
					if($countSubject>0){
						return Html::a($countSubject, ['program-subject/index','tb_program_id'=>$data->id], ['class' => 'badge']);
					}
					else{
						return Html::a('+', ['program-subject/index','tb_program_id'=>$data->id], ['class' => 'badge']);
					}
				}
			],
			
            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
				Html::a('<i class="fa fa-fw fa-plus"></i> Create Program', ['create'], ['class' => 'btn btn-success']). ' '.
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/program/index']).'?status="+$(this).val(), container: "#pjax-program-gridview", timeout: 1});
						',	
						'data-pjax' => true,
					],
				]).
				'</div>',
			'after'=>
				Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); 
	?>
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
