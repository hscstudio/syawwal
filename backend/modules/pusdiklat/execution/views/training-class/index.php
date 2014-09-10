<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\TrainingClassSearch */

$this->title = 'Classes : '.\yii\helpers\Inflector::camel2words($training->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],            
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'class',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Class', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
			[
				'format' => 'raw',
				'label' => 'Subject',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data)
				{
					$classSubjectCount = \backend\models\TrainingClassSubject::find()->where(['tb_training_class_id' => $data->id])->count();
					$SubjectCount = \backend\models\ProgramSubjectHistory::find()->where([
						'tb_program_id' => $data->training->tb_program_id,
						'revision'=> $data->training->tb_program_revision,
						'status'=>1,
					])->count();
					
					if($SubjectCount>$classSubjectCount){
						return Html::a($classSubjectCount, 
							['/'.$this->context->module->uniqueId.'/training-class-subject/create',
							'tb_training_class_id'=>$data->id], 
							['title'=>$classSubjectCount,
							'class' => 'label label-default','data-pjax'=>0,'data-toggle'=>"tooltip",
							'data-placement'=>"top"]);
					}
					else{
						return Html::a($classSubjectCount, 
							['/'.$this->context->module->uniqueId.'/training-class-subject/index',
							'tb_training_class_id'=>$data->id], 
							['title'=>$classSubjectCount,
							'class' => 'label label-default','data-pjax'=>0,'data-toggle'=>"tooltip",
							'data-placement'=>"top"]);
					}
				}
			],
			[
				'format' => 'raw',
				'label' => 'Schedule',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){
					return Html::a('SET',
						\yii\helpers\Url::to(['schedule','tb_training_class_id'=>$model->id]),
						['class'=>'label label-default']);
				}
			],
			[
				'format' => 'raw',
				'label' => 'Student',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){
					$studentCount = \backend\models\TrainingClassStudent::find()
						->where([
							'tb_training_class_id'=>$model->id,
							'status'=>1
						])->count();
					return Html::a($studentCount,
						\yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class-student/index']),
						[]);
				}
			],
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					$icon = ($data->status==1)?'<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>';
					return $icon;						
				}
			],
            [
				'class' => 'kartik\grid\ActionColumn',
				'template'=>'{delete}',
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training', \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index']), ['class' => 'btn btn-warning']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Class', ['create','tb_training_id'=>$training->id], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_training_id'=>$training->id], ['class' => 'btn btn-info']),
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
		
		
	echo Html::endTag('div');
	?>

</div>
