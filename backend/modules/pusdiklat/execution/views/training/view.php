<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\models\Training */

$this->title = \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-view">
	<?php
	function showLabel($status){
		if ($status==1){
			$icon='<span class="glyphicon glyphicon-check"></span>';
			$label='label label-info';
			$title='READY';
		}	
		else if ($status==2){ 
			$icon='<span class="glyphicon glyphicon-refresh"></span>';
			$label='label label-success';
			$title='EXECUTE';
		}
		else if ($status==3){ 
			$icon='<span class="glyphicon glyphicon-trash"></span>';
			$label='label label-danger';
			$title='CANCEL';
		}
		else {
			$icon='<span class="glyphicon glyphicon-fire"></span>';
			$label='label label-warning';
			$title='PLAN';
		}
		return Html::tag('span', $icon.' '.$title, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
	}
	
	$panel = [
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Trainings # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		];
	if (Yii::$app->request->isAjax){	
		$panel = [];
	}
	?>
	
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#view" role="tab" data-toggle="tab">View</a></li>
		<li><a href="#student" role="tab" data-toggle="tab">Sebaran Peserta</a></li>
		<li><a href="#document" role="tab" data-toggle="tab">Dokumen Diklat</a></li>
		<li><a href="#subjectTrainer" role="tab" data-toggle="tab">Subject Trainer</a></li>
	</ul>

	<!-- Tab panes -->	
	<div class="tab-content" style="border: 1px solid #ddd; border-top-color: transparent; padding:5px; background-color: #fff;">
	  <div class="tab-pane active" id="view">
	  <?= DetailView::widget([
			'model' => $model,
			'mode'=>DetailView::MODE_VIEW,
			'panel'=> $panel,
			'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index'],
							['class'=>'btn btn-xs btn-primary',
							 'title'=>'Back to Index',
							]).' ',
			'attributes' => [
				'id',
				[
					'attribute' => 'tb_program_id',
					'format' => 'html',
					'label' => 'Program',
					'value' => $model->program->name.' => Rev : '.Html::a(($model->tb_program_revision>0)?$model->tb_program_revision.'x':'-', '#', [
							'class'=>'label label-danger',
						]).' ',
				],
				[
					'attribute' => 'ref_satker_id',
					'label' => 'Satker',
					'value' => $model->satker->name,
				],
				'number',
				'name',
				'start',
				'finish',
				'note',
				'studentCount',
				'classCount',
				'executionSK',
				'resultSK',
				'costPlan',
				'costRealisation',
				'sourceCost',
				'hostel',
				'reguler',
				'stakeholder',
				'location',
				[
					'format' => 'html',
					'attribute' => 'status',
					'value' => showLabel($model->status),
				],
				'created',
				'createdBy',
				'modified',
				'modifiedBy',
				'deleted',
				'deletedBy',
				'approvedStatus',
				'approvedStatusNote',
				'approvedStatusDate',
				'approvedStatusBy',
			],
		]) ?>
	  
	  </div>
	  <div class="tab-pane" id="student">		
		<?php
			$provider = new yii\data\ActiveDataProvider([
				'query' => \backend\models\Unit::find()->where('id>0'),
				'pagination' => [
					//'pageSize' => 20,
				]
			]);
			$tups = explode('|', @$model->trainingUnitPlans->spread);
			echo GridView::widget([
				'dataProvider' => $provider,
				'columns' =>[
					['class' => 'kartik\grid\SerialColumn'],
					'shortname',
					[
						'label' => 'Rencana',
						'format' => 'html',
						'value' => function ($data) use ($tups){
							return @$tups[$idx-1];
						},
						
					],
					[
						'label' => 'Realisasi',
						'value' => function ($data) use ($model){
							$tcs = \backend\models\TrainingClassStudent::find()
								->select('count(id) as studentCount')
								->where([
									'tb_training_id'=>$model->id,
									'tb_student_id'=>\backend\models\Student::find()
										->select('id')
										->where([
											'ref_unit_id'=>$data->id,
											'status'=>1,
										])
										->all(),
									'status'=>1,
								])
								->asArray()
								->one();
							return $tcs['studentCount'];
						},
						
					],					
				],
				'responsive'=>true,
				'hover'=>true,
			]);
			?>
		</div>
		<div class="tab-pane" id="document">
			<?php
			$provider = new yii\data\ActiveDataProvider([
				'query' => backend\models\ProgramDocument::find()
							->where([
								'type' => ['GBPP','KAP'],
								'tb_program_id' => $model->tb_program_id,
								'revision' => $model->tb_program_revision,
								'status' => 1,
							]),
				'pagination' => [
					//'pageSize' => 20,
				]
			]);
			
			echo GridView::widget([
				'dataProvider' => $provider,
				'columns' =>[
					['class' => 'kartik\grid\SerialColumn'],
					'type',
					[
						'label' => 'Download',
						'format' => 'html',
						'value' => function ($data) use ($model){
							return Html::a($data->name, ['/file/download','file'=>'program/'.$data->tb_program_id.'/document/'.$data->filename], [
								'class' => 'badge',
								'title' => $data->description,
								'data-toggle' => 'tooltip',
								'data-placement'=> 'top',
								'data-pjax' => '0',
							]);
						},
						
					],
					[
						'attribute' => 'modified',
						'value' => function ($data){
							$user = \backend\models\User::findOne($data->modifiedBy);
							if(!null==$user){
								return 'by '.$user->employee->name.' ('.$user->employee->phone.') [at] '.$data->modified;
							}	
						},
						
					],					
				],
				'responsive'=>true,
				'hover'=>true,
			]);
			?>
		</div>
		<div  class="tab-pane"  id="subjectTrainer">			
			<?php
			$provider = new yii\data\ActiveDataProvider([
				'query' => \backend\models\ProgramSubjectHistory::find()
								->where([
									'tb_program_id' => $model->tb_program_id,
									'revision' => $model->tb_program_revision,
									'status' => 1,
								]),
				'pagination' => [
					//'pageSize' => 20,
				]
			]);
			
			echo GridView::widget([
				'dataProvider' => $provider,
				'columns' =>[
					['class' => 'kartik\grid\SerialColumn'],
					[
						'attribute' => 'ref_subject_type_id',
						'value' => function ($data){
							return $data->subjectType->name;
						},
						
					],
					'name',
					'hours',
					[
						'attribute' => 'test',
						'value' => function ($data){
							return ($data->test==1)?'Yes':'No';
						},
						
					],
					[
						'label' => 'Trainer',
						'format' => 'html',
						'value' => function ($data) use ($model){
							$trainingTrainers = \backend\models\TrainingScheduleTrainer::find()
								->where([
									'tb_training_schedule_id'=>
										\backend\models\TrainingSchedule::find()
											->select('id')
											->where([
												'tb_training_class_id'=>
													\backend\models\TrainingClass::find()
														->select('id')
														->where([
															'tb_training_id'=>$model->id,
															'status'=>1,
														]),
												'tb_training_class_subject_id'=>
													\backend\models\TrainingClassSubject::find()
														->select('id')
														->where([
															'tb_program_subject_id'=>$data->tb_program_subject_id,
															'status'=>1,
														]),
												'status'=>1,
											]),
									'status'=>1,
								])
								->groupBy('tb_trainer_id')
								->orderBy('ref_trainer_type_id')
								->all();
							$idx=1;
							$content = "";
							$type = "";
							foreach($trainingTrainers as $tt){
								if($type!=$tt->trainerType->name){
									$type=$tt->trainerType->name;
									$content .= "<strong>".$type."</strong><br>";
								}
								$content .= Html::a($idx. '. '.$tt->trainer->name,'#',['title'=>$tt->trainer->phone.' - '.$tt->trainer->organization]).'<br>';
								$idx++;
							}
							
							return $content;
						},
						
					],
					[
						'attribute' => 'modified',
						'value' => function ($data){
							$user = \backend\models\User::findOne($data->modifiedBy);
							if(!null==$user){
								return 'by '.$user->employee->name.' ('.$user->employee->phone.') [at] '.$data->modified;
							}	
						},
						
					],					
				],
				'responsive'=>true,
				'hover'=>true,
			]);
			?>
		</div>
	</div>  
	
</div>
