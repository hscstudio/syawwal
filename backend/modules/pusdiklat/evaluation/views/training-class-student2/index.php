<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\TrainingClassStudentSearch */

$this->title = 'Student : '.\yii\helpers\Inflector::camel2words($training->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training2/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class2/index','tb_training_id'=>$tb_training_id])];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-student-index">

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
				'attribute' => 'tb_student_id',
				'label' => 'Name',
				'value' => function ($data) {
					return $data->trainingStudent->student->name;
				}
			],
			[
				'label' => 'NIP',
				'width' => '200px',
				'value' => function ($data) {
					return $data->trainingStudent->student->nip;
				}
			],
			[
				'label' => 'Satker',
				'format' => 'raw',
				'width' => '200px',
				'value' => function ($model) {
					$eselon = $model->trainingStudent->student->satker;
					$satker = [
						'1'=>$model->trainingStudent->student->unit->shortname.' ',
						'2'=>$model->trainingStudent->student->eselon2.' ',
						'3'=>$model->trainingStudent->student->eselon3.' ',
						'4'=>$model->trainingStudent->student->eselon4.' ',
					];			
					
					$icon=$satker[$eselon];
					$label='label label-success';
					$title=($eselon==1)?'':'Eselon '.($eselon-1).': '.$satker[$eselon-1];					
					
					return Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				}
			],            
            [
				'class' => 'kartik\grid\ActionColumn',
				'template'=>'{update} {view} {check}',
				'buttons' => [
					'update' => function ($url, $model) use ($tb_training_id,$tb_training_class_id) {
								$icon='<span class="glyphicon glyphicon-pencil"></span>';
								$url2=['update','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
								return Html::a($icon,$url2,[
									'data-pjax'=>"0",
								]);
							},
					
					'view' => function ($url, $model)use ($tb_training_id,$tb_training_class_id) {
								$icon='<span class="glyphicon glyphicon-eye-open"></span>';
								$url2=['view','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
								return Html::a($icon,$url2,[
									'data-pjax'=>"0",
								]);
							},
					'check' => function ($url, $model)use ($tb_training_id,$tb_training_class_id) {
						$icon='<span class="glyphicon glyphicon-check"></span>';
						$check[] = ((empty($model->trainingStudent->student->name))?'':'<span class="glyphicon glyphicon-check"></span>').' name';
						$title = implode('<br>',$check);
						return Html::a($icon,'#',[
									'data-pjax'=>"0",
									'data-toggle'=>"tooltip",
									'data-html'=>"true",
									'title'=>$title
								]);
						
					},
				],			
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training Class', \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class2/index','tb_training_id'=>$tb_training_id]), ['class' => 'btn btn-warning']).' '.
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'class', 
					'data' => $listTrainingClass,
					'value' => $tb_training_class_id,
					'options' => [
						'placeholder' => 'Class ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['index','tb_training_id'=>$tb_training_id]).'&tb_training_class_id="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id], ['class' => 'btn btn-info']),
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
	
	<?php \yii\widgets\Pjax::end(); ?>
	
</div>
