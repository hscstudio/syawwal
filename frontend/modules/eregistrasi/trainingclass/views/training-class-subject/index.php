<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel frontend\models\TrainingClassSubjectSearch */

$this->title = 'Training Class Subjects';
$this->params['breadcrumbs'][] = ['label'=>'Trainings','url'=>['../eregistrasi-student/training/index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

           
				[
					'format' => 'html',
					'attribute' => 'tb_program_subject_id',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value'=> function ($data){
						return Html::a($data->programSubject->name);
					},
				],
				[
					'format' => 'html',
					'attribute' => 'trainer',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data){
						return Html::a(\frontend\models\TrainingScheduleTrainer::findOne(
											['tb_training_schedule_id'=>\frontend\models\TrainingSchedule::find()
															->select('id')
															->where(['tb_training_class_subject_id'=>$data->id,
																	 'status'=>1,]),
													  'status'=>1,'ref_trainer_type_id'=>!2])->trainer->name);
					},
				],
				
				[
				 	'class' => 'kartik\grid\ActionColumn',
					'template' => '{update}',					
					'buttons' => [
						'update' => function ($url, $data) {
									$icon='<span class="glyphicon glyphicon-pencil"></span>';
									return ($data->status!=2 AND $data->status!=1)?'':Html::a($icon,\yii\helpers\Url::to('../training-class-subject-trainer-evaluation/index?tb_training_id='.Yii::$app->request->get('tb_training_id').'&tb_training_class_subject_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode($data->id)).'&tb_trainer_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode(\frontend\models\TrainingScheduleTrainer::findOne(
											['tb_training_schedule_id'=>\frontend\models\TrainingSchedule::find()
															->select('id')
															->where(['tb_training_class_subject_id'=>$data->id,
																	 'status'=>1,]),
													  'status'=>1,'ref_trainer_type_id'=>!2])->tb_trainer_id))),[
										'data-pjax'=>"0",
									]);
								},
					],	
				],
            //['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Training Class Subject</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i>'.\frontend\models\Training::findOne($tb_training_id)->name.'</h3>',
			//'type'=>'primary',
			//'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Class Subject', ['create'], ['class' => 'btn btn-success']),
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
		
	echo Html::endTag('div');
	?>

</div>
