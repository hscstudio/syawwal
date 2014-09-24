<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use backend\models\ProgramSubjectHistory;
use backend\models\SubjectType;

$this->title = 'Subject : Class '.$trainingClass->class;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($trainingClass->training->name), 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$trainingClass->tb_training_id])];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'label'=>'Type',
				'hAlign'=>'center',
				'value' => function ($data) {
					$program = $data->trainingClass->training->tb_program_id;
					$program_revision = $data->trainingClass->training->tb_program_revision;
					$programSubjects = ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $data->tb_program_subject_id,
							'tb_program_id' => $program,
							'revision' => $program_revision,
							'status' => 1
						])
						->one();
					$subjectType = SubjectType::find()
						->where(['id' => $programSubjects->ref_subject_type_id])
						->one();
					return $subjectType->name;
				}
			],
			[
				'attribute' => 'tb_program_subject_id',
				'label'=>'Program Subject',
				'value' => function ($data) {
					$program = $data->trainingClass->training->tb_program_id;
					$program_revision = $data->trainingClass->training->tb_program_revision;
					$programSubjects = ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $data->tb_program_subject_id,
							'tb_program_id' => $program,
							'revision' => $program_revision,
							'status' => 1
						])
						->one();
					return $programSubjects->name;
				}
			],
			[
				'label'=>'JP',
				'hAlign'=>'center',
				'value' => function ($data) {
					$program = $data->trainingClass->training->tb_program_id;
					$program_revision = $data->trainingClass->training->tb_program_revision;
					$programSubjects=ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $data->tb_program_subject_id,
							'tb_program_id'=>$program,
							'revision'=>$program_revision,
							'status'=>1
						])
						->one();
					return $programSubjects->hours;
				}
			],
            [
            	'class' => '\kartik\grid\BooleanColumn',
		        'trueLabel' => 'Yes', 
		        'falseLabel' => 'No',
		        'width' => '80px',
				'label'=>'Test',
				'hAlign'=>'center',
				'value' => function ($data) {
					$program = $data->trainingClass->training->tb_program_id;
					$program_revision = $data->trainingClass->training->tb_program_revision;
					$programSubjects=ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $data->tb_program_subject_id,
							'tb_program_id'=>$program,
							'revision'=>$program_revision,
							'status'=>1
						])
						->one();
					return ($programSubjects->test==1)?'Yes':'No';
				}
			],
			[
				'label'=>'Sort',
				'hAlign'=>'center',
				'width' => '80px',
				'value' => function ($data) {
					$program = $data->trainingClass->training->tb_program_id;
					$program_revision = $data->trainingClass->training->tb_program_revision;
					$programSubjects=ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id' => $data->tb_program_subject_id,
							'tb_program_id'=>$program,
							'revision'=>$program_revision,
							'status'=>1
						])
						->one();
					return $programSubjects->sort;
				}
			],
			[
				'label'=>'Trainer',
				'format'=>'raw',
				'width' => '80px',
				'hAlign'=>'center',
				'value' => function ($data) {
					$trainerCount=\backend\models\TrainingClassSubjectTrainer::find()
						->where([
							'tb_training_class_subject_id'=>$data->id,
							'status'=>1
						])
						->count();
					return Html::a('<strong>'.$trainerCount.'</strong>',
						\yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class-subject-trainer/index',
						'tb_training_class_subject_id'=>$data->id]),
						['class'=>'btn btn-info btn-xs']);
				}
			],
			[
				'class' => '\kartik\grid\BooleanColumn',
		        'trueLabel' => 'Yes', 
		        'falseLabel' => 'No',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column']
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=> '<div class="btn-group">'.
				Html::a('<i class="fa fa-fw fa-arrow-circle-left"></i> Back', Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','trainingId'=>$trainingClass->tb_training_id]), ['class' => 'btn btn-primary']).' '.
				Html::a('<i class="fa fa-fw fa-gear fa-spin"></i> Auto Generate Training Class Subject', ['create','tb_training_class_id'=>$trainingClass->id], ['class' => 'btn btn-danger'])
				.'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_training_class_id'=>$trainingClass->id], ['class' => 'btn btn-info']),
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
