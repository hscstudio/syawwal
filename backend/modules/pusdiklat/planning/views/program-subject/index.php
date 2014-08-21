<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\ProgramSubjectSearch */

$this->title = $program_name;
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

?>
<div class="program-subject-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            /*
				[
					'attribute' => 'tb_program_id',
					'value' => function ($data) {
						return $data->program->name;
					}
				],
				*/
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'type',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Type', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
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
					'attribute' => 'hours',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Hours', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'sort',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Sort', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'test',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Test', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
           
			
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Document',
				'value' => function ($data) {
					$countSubjectDoc = \backend\models\ProgramSubjectDocument::find()
								->where(['tb_program_subject_id' => $data->id,])
								->active()
								->count();
					if($countSubjectDoc>0){
						return Html::a($countSubjectDoc, 
							['program-subject-document/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], 
							['class' => 'label label-primary','data-pjax' => '0']);
					}
					else{
						return Html::a('+', ['program-subject-document/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], ['class' => 'label label-primary','data-pjax' => '0']);
					}
				}
			],
			
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'50px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					$icon = ($data->status==1)?'<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>';
					return Html::a($icon, ['status','status'=>$data->status, 'id'=>$data->id], [
						'onclick'=>'
							$.pjax.reload({url: "'.\yii\helpers\Url::to(['status','status'=>$data->status, 'id'=>$data->id]).'", container: "#pjax-gridview", timeout: 3000});
							return false;
						',
						'class'=>($data->status==1)?'label label-info':'label label-warning',
					]);
					
				}
			],
			
            [
				'class' => 'kartik\grid\ActionColumn',
				'buttons'=>[
					'update' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update','id'=>(int)$model->id,'tb_program_id'=>(int)$model->tb_program_id], ['class' => '']);
					},
					'delete' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete','id'=>(int)$model->id,'tb_program_id'=>(int)$model->tb_program_id], ['title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post", 'data-pjax'=>"0"]);
					},
				],
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Subject</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
			Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Program', ['program/index'], ['class' => 'btn btn-warning']).' '.
			Html::a('<i class="fa fa-fw fa-plus"></i> Create Program Subject', ['create','tb_program_id'=>(int)$tb_program_id], ['class' => 'btn btn-success']).' '.
			'<div class="pull-right" style="margin-right:5px;">'.
			Select2::widget([
				'name' => 'status', 
				'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
				'value' => $status,
				'options' => [
					'placeholder' => 'Status ...', 
					'class'=>'form-control', 
					'onchange'=>'
						$.pjax.reload({url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/program-subject/index']).'?tb_program_id='.(int)$tb_program_id.'&status="+$(this).val(), container: "#pjax-gridview", timeout: 1});
					',	
					'data-pjax' => '1',
				],
			]).
			'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_program_id'=>(int)$tb_program_id,'status'=>$status], ['class' => 'btn btn-info']),
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
