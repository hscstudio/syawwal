<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\TrainingSearch */

$this->title = 'Trainings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-index">

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-training-gridview',
	]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            	['class' => 'kartik\grid\SerialColumn'],
                        
				[
					'format' => 'raw',
					'attribute' => 'name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data){
						return '<div title="'.$data->note.'" data-toggle="tooltip" data-placement="top">'.$data->name.'</div>';
					}
				],
            
				[
					'attribute' => 'start',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						return date('d F Y', strtotime($data->start));
					}
				],
            
				[
					'attribute' => 'finish',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						return date('d F Y', strtotime($data->finish));
					}
				],
            
				[
					'attribute' => 'classCount',
					'format' => 'raw',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data)
					{
						if ($data->classCount > 0)
						{
							$fOut = '<div class="label alert-success">';
							$fOut .= $data->classCount;
							$fOut .= '</div>';
							return $fOut;
						}
						else
						{
							$fOut = '<a class="label alert-danger" data-toggle="modal" data-target="#modalAddClass">
										<i class="fa fa-fw fa-plus-square"></i>
										Add Class
									</a>';

							$fOut .= '<div class="modal fade" id="modalAddClass" tabindex="-1" role="dialog" aria-labelledby="modalAddClass" aria-hidden="true">
									  <div class="modal-dialog modal-sm">
									    <div class="modal-content">';

							$fOut .= Html::beginForm(Url::to('bdk-execution/training/addClassCount'), 'post', [
								'class' => 'form',
								'role' => 'form'
							]);

							$fOut .= '    <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									        <h4 class="modal-title">Add Class Count</h4>
									      </div>
									      <div class="modal-body">';

							$fOut .= Html::input('text', 'classCount', null, [
									'class' => 'form-control'
								]);

							$fOut .= '     </div>';
							$fOut .= '    <div class="modal-footer">
									        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
							$fOut .= Html::hiddenInput('id', $data->id);
							$fOut .= '      <button type="button" class="btn btn-primary">Save</button>
									      </div>';
							
							$fOut .= Html::endForm();

							$fOut .= '  </div>
									  </div>
									</div>';
							return $fOut;
						}
					}
				],
            
				[
					'attribute' => 'studentCount',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
				[
					'format' => 'html',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Status',
					'value' => function ($data)
					{
						if ($data->approvedStatus === null)
						{
							return '<p class="label label-warning"><i class="fa fa-fw fa-square"></i> Waiting for approval</p>';
						}
						elseif ($data->approvedStatus === 0) {
							return '<p class="label label-danger"><i class="fa fa-fw fa-minus-square"></i> Rejected</p>';
						}
						else
						{
							return '<p class="label label-success"><i class="fa fa-fw fa-check-square"></i> Approved</p>';
						}
					}
				],
				[
					'format' => 'html',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Revision',
					'value' => function ($data) {
						$countRevision = \backend\models\TrainingHistory::find()
									->where(['tb_training_id' => $data->id,])
									->count()-1;
						if($countRevision>0){
							return Html::a($countRevision.' x', ['training-history/','tb_training_id'=>$data->id], ['class' => 'label label-danger']);
						}
						else{
							return '<span class="label label-danger">0</span>';
						}
					}
				],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training List</h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training', ['create'], ['class' => 'btn btn-success']). ' '.
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'Show All'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training/index']).'?status="+$(this).val(), container: "#pjax-training-gridview", timeout: 1});
						',	
						'data-pjax' => true,
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
