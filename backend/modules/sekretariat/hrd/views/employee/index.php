<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
/* @var $searchModel backend\models\EmployeeSearch */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="employee-index">

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
					'attribute' => 'name',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
				
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nip',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Nip', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nickName',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'NickName', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'frontTitle',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'FrontTitle', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'backTitle',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'BackTitle', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
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

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Employee</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Employee', ['create'], ['class' => 'btn btn-success']). ' '.
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/employee/index']).'?status="+$(this).val(), 
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
