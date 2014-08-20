<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use yii\helpers\ArrayHelper;
/* @var $searchModel backend\models\ProgramCodeSearch */

$this->title = 'Program Codes';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
$datadropdown = ArrayHelper::map(\backend\models\ProgramCode::find()->select(['id','name'])->asArray()->all(),'id','name');
?>
<div class="program-code-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'code',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Code', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'parent_id',
					'value' => function ($data) {
						$parent = \backend\models\ProgramCode::findOne($data->parent_id);
						return ($data->parent_id==0)?'----' : $parent->name;
					},
					'editableOptions'=>['header'=>'parent_id',
										'inputType' => 'dropDownList',
										'data'=>array_merge([0=>'----'],$datadropdown),
										'editableValueOptions'=>['class'=>'text-danger'],
										'formOptions'=>['action'=>\yii\helpers\Url::to('editable')]
										]
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
            // 'createdBy',
            // 'modified',
            // 'modifiedBy',
            // 'deleted',
            // 'deletedBy',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Code</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Program Code', ['create'], ['class' => 'btn btn-success']),
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
