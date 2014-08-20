<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\ProgramDocumentSearch */

$this->title = 'Program Documents';
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-document-index">

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
				'attribute' => 'type',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Type', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'format' => 'raw',
				'attribute' => 'filename',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::a($data->filename, ['/file/download','file'=>'program/'.$data->tb_program_id.'/document/'.$data->filename], [
						'class' => 'badge',
						'data-pjax' => '0',
					]);
				}
			],
            
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'description',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Description', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
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
					$icon = ($data->status==1)?'<span class="glyphicon glyphicon-ok text-success"></span>':'<span class="glyphicon glyphicon-remove text-danger"></span>';
					return Html::a($icon, ['status','status'=>$data->status, 'id'=>$data->id], [
						'onclick'=>'
							$.pjax.reload({url: "'.\yii\helpers\Url::to(['status','status'=>$data->status, 'id'=>$data->id]).'", container: "#pjax-gridview", timeout: 3000});
							return false;
						'
					]);
					
				}
			],
            // 'created',
            // 'createdBy',
            // 'modified',
            // 'modifiedBy',
            // 'deleted',
            // 'deletedBy',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Document</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
				Html::a('<i class="fa fa-fw fa-plus"></i> Create Program Document', ['create','tb_program_id'=>(int)$tb_program_id], ['class' => 'btn btn-success']).
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/program-document/index']).'?tb_program_id='.(int)$tb_program_id.'&status="+$(this).val(), container: "#pjax-gridview", timeout: 1});
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
			
		echo Html::endTag('div');
		
	echo Html::endTag('div');
	?>

</div>
