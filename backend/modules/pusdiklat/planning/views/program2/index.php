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
				'width'=>'80px',
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
				'label' => 'Doc',
				'width'=>'50px',
				'value' => function ($data) {
					$countSubject = \backend\models\ProgramDocument::find()
								->where(['tb_program_id' => $data->id,])
								->active()
								->count();
					if($countSubject>0){
						return Html::a($countSubject, ['program-document2/index','tb_program_id'=>$data->id], ['class' => 'label label-primary']);
					}
					else{
						return Html::a('+', ['program-document2/index','tb_program_id'=>$data->id], ['class' => 'label label-primary']);
					}
				}
			],
			[
				'format' => 'html',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Rev',
				'width'=>'50px',
				'value' => function ($data) {
					$countRevision = \backend\models\ProgramHistory::find()
								->where(['tb_program_id' => $data->id,])
								->count()-1;
					if($countRevision>0){
						return Html::a($countRevision.'x', ['program-history2/index','tb_program_id'=>$data->id], ['class' => 'label label-danger']);
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
						return Html::a($countSubject, ['program-subject2/index','tb_program_id'=>$data->id], ['class' => 'label label-success']);
					}
					else{
						return Html::a('+', ['program-subject2/index','tb_program_id'=>$data->id], ['class' => 'label label-success']);
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
				'template' => '{view} {update}',
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
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
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/program2/index']).'?status="+$(this).val(), 
								container: "#pjax-program-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>
				Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info', 'data-pjax'=>'0']),
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
		
		
		
	echo Html::endTag('div');
	?>

</div>
