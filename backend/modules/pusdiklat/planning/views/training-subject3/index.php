<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\ProgramSubjectSearch */

$this->title = \yii\helpers\Inflector::camel2words('Subject : '.$program_name);
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['training3/index']];
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

            [
				'attribute' => 'type',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'150px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'format' => 'html',
				'value' => function ($data) {
					$type ="";
					if($data->type==0) $type = "MP";
					if($data->type==1) $type = "CERAMAH";
					if($data->type==2) $type = "MFD";
					if($data->type==3) $type = "OJT";
					return '<span class="badge">'.$type.'</div>';
				}
			],
		
			[
				'attribute' => 'name',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
            
			[
				'attribute' => 'hours',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
		
			[
				'attribute' => 'test',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
           
			
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'label' => 'Doc',
				'value' => function ($data) {
					$countSubjectDoc = \backend\models\ProgramSubjectDocument::find()
								->where(['tb_program_subject_id' => $data->id,])
								->active()
								->count();
					if($countSubjectDoc>0){
						return Html::a($countSubjectDoc, 
							['program-subject-document3/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], 
							['class' => 'label label-primary','data-pjax' => '0']);
					}
					else{
						return Html::a('+', ['program-subject-document3/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], ['class' => 'label label-primary','data-pjax' => '0']);
					}
				}
			],
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'75px',
				'label' => 'Trainer',
				'value' => function ($data) {
					$countSubjectDoc = \backend\models\ProgramSubjectDocument::find()
								->where(['tb_program_subject_id' => $data->id,])
								->active()
								->count();
					if($countSubjectDoc>0){
						return Html::a($countSubjectDoc, 
							['training-subject-trainer-recommendation3/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], 
							['class' => 'label label-primary','data-pjax' => '0']);
					}
					else{
						return Html::a('+', ['training-subject-trainer-recommendation3/index','tb_program_id'=>$data->tb_program_id,'tb_program_subject_id'=>$data->id], ['class' => 'label label-primary','data-pjax' => '0']);
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
					return Html::a($icon, '#', [
						'class'=>($data->status==1)?'label label-info':'label label-warning',
					]);
					
				}
			],			
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view}',
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Program Subject</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>
			Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training', ['training3/index'], ['class' => 'btn btn-warning']).' '.
			'<div class="pull-right" style="margin-right:5px;">'.
			Select2::widget([
				'name' => 'status', 
				'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
				'value' => $status,
				'options' => [
					'placeholder' => 'Status ...', 
					'class'=>'form-control', 
					'onchange'=>'
						$.pjax.reload({url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training-subject3/index']).'?tb_program_id='.(int)$tb_program_id.'&status="+$(this).val(), container: "#pjax-gridview", timeout: 1});
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
		
	echo Html::endTag('div');
	?>

</div>
