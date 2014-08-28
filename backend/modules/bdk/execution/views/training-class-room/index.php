<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use backend\models\Training;
use yii\widgets\ActiveForm;

/* @var $searchModel backend\models\TrainingClassRoomSearch */

$this->title = 'Training Class Rooms';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-room-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
	            ['class' => 'kartik\grid\SerialColumn'],
            
				[
					'attribute' => 'name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],

				[
					'label' => 'Class',
					'vAlign'=>'middle',
					'format' => 'raw',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function($data)
					{
						$f = '';
						foreach ($data->trainingClassRoom as $k) {
							$f .= '<div class="label alert-success">'.$k->class;
							$f .= '<a class="text-success" data-method="post" type="submit" href="'.Yii\helpers\Url::to(['delete']).'/?id='.$data->id.'" ><i class="fa fa-fw fa-times"></i></a>';
							$f .= '</div> ';
						}
						return $f;
					}
				],

				[
					'label' => 'Action',
					'format' => 'raw',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data) use ($packageRoom)
					{
						$modalAddClass = 
						'<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalClass'.$data->id.'">
						  <i class="fa fa-fw fa-plus"></i>
						  Add Class
						</button>

						<div class="modal fade" id="modalClass'.$data->id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">';

						$modalAddClass .=  Html::beginForm('create', 'post', [
							'class' => 'form', 'role' => 'form'
						]);

						$modalAddClass .= '
							    	<div class="modal-header">
							    		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							    		<h4 class="modal-title"><i class="fa fa-fw fa-inbox"></i>Add Class</h4>
							    	</div>
							    	<div class="modal-body">';

						$modalAddClass .= '<div class="form-group">';
						$modalAddClass .= html::label('Class Name', 'class');
						$modalAddClass .= Html::input('text', 'class', null, [
							'placeholder' => 'Class name can be up to 3 characters long',
							'class' => 'form-control'
						]);
						$modalAddClass .= '</div>';

						$modalAddClass .= '<div class="form-group">';
						$modalAddClass .= html::label('Room Available', 'tb_room_id');
						$modalAddClass .= Html::dropDownList('tb_room_id', null, $packageRoom, ['class' => 'form-control']);
						$modalAddClass .= '</div>';

						$modalAddClass .= '
							    	</div>
							    	<div class="modal-footer">
							    		<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-times"></i>Cancel</button>
							    		<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i>Add</button>
							    	</div>';

						$modalAddClass .= Html::hiddenInput('tb_training_id', $data->id);

						$modalAddClass .= Html::endForm();

						$modalAddClass .= '
						    </div>
						  </div>
						</div>';

						return $modalAddClass;
					}
				]

        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
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
