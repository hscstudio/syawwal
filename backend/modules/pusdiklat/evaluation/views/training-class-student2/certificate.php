<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use kartik\widgets\DatePicker;

/* @var $searchModel backend\models\TrainingClassStudentSearch */

$this->title = 'Certificate : '.\yii\helpers\Inflector::camel2words($training->name);
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
				'label' => 'CERTIFICATE',
				'format' => 'raw',
				'width' => '200px',
				'value' => function ($model) {
					$certificate = backend\models\TrainingClassStudentCertificate::findOne($model->id);
					if (null!=$certificate){
						$icon='<span class="glyphicon glyphicon-check"></span>';
						$label='label label-success';
						$title='Get Certificate';
					}	
					else{ 
						$icon='-';
						$label='';
						$title='-';
					}
					
					return Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				}
			],
            /*
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'number',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Number', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'headClass',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'HeadClass', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'activity',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Activity', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'presence',
				//'pageSummary' => 'Page Total',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Presence', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'pretest',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Pretest', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'posttest',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Posttest', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
			*/
            [
				'class' => 'kartik\grid\ActionColumn',
				'template'=>'{create} {update} {view} {delete}',
				'buttons' => [
					'update' => function ($url, $model) use ($tb_training_id,$tb_training_class_id) {
								$certificate = backend\models\TrainingClassStudentCertificate::findOne($model->id);
								if (null!=$certificate){
									$icon='<span class="glyphicon glyphicon-pencil"></span>';
									$url2=['update2','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
									return Html::a($icon,$url2,[
										'data-pjax'=>"0",
									]);
								}
							},
					'delete' => function ($url, $model) use ($tb_training_id,$tb_training_class_id) {
								$certificate = backend\models\TrainingClassStudentCertificate::findOne($model->id);
								if (null!=$certificate){
									$icon='<span class="glyphicon glyphicon-trash"></span>';
									$url2=['delete2','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
									return Html::a($icon,$url2,[
										'title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post",
										'data-pjax'=>"0",
									]);
								}
							},
					'view' => function ($url, $model)use ($tb_training_id,$tb_training_class_id) {
								$certificate = backend\models\TrainingClassStudentCertificate::findOne($model->id);
								if (null!=$certificate){
									$icon='<span class="glyphicon glyphicon-eye-open"></span>';
									$url2=['view2','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
									return Html::a($icon,$url2,[
										'data-pjax'=>"0",
									]);
								}
							},
					'create' => function ($url, $model)use ($tb_training_id,$tb_training_class_id) {
								$certificate = backend\models\TrainingClassStudentCertificate::findOne($model->id);
								if (null!=$certificate){
								}
								else{
									$icon='<span class="glyphicon glyphicon-plus"></span>';
									$url2 = ['create2','id'=>$model->id,'tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id];
									return Html::a($icon,$url2,[
										'data-pjax'=>"0",
									]);
								}
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
								url: "'.\yii\helpers\Url::to(['certificate','tb_training_id'=>$tb_training_id]).'&tb_training_class_id="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	
	<div class="panel panel-default">
        <div class="panel-heading">
             <h3 class="panel-title"><i class="fa fa-fw fa-refresh"></i> Document Generator</h3>
        </div>
		
		<div class="row">
			<div class="col-md-6">

			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'action' => ['print-frontend-certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id],
				'options' => [
					'class' => 'form-horizontal',					
				],
			]) ?>
				<?php //Html::input( $type, $name = null, $value = null, $options = [] ) ?>
				
				<table class="table table-condensed table-striped" style="width:90%;margin:10px auto;">
				<tr>
					<th colspan="2"><label>Frontend Certificate</label></th>
				</tr>
				<tr>
					<td>Certificate Type</td>
					<td>
					<?php
					$type_certificate=0;
					
					$name_training = trim($training->name);
					// DETECT DIKLAT
					if(substr($name_training,0,7)=='DIKLAT '){
						$name_training = trim(substr($name_training, 7 , 255)); // because in template Pendidikan dan Pelatihan
					}
					else if(substr($name_training,0,4)=='DTU '){
						$name_training = trim(substr($name_training, 4 , 255));
					}
					else if(substr($name_training,0,5)=='DTSD '){
						$name_training = trim(substr($name_training, 5 , 255));
					}
					else if(substr($name_training,0,5)=='DTSS '){
						$name_training = trim(substr($name_training, 5 , 255));
					}
					else if(substr($name_training,0,4)=='DFP '){
						$name_training = trim(substr($name_training, 4 , 255));
						$type_certificate = 1;
					}
					else if(substr($name_training,0,3)=='DF '){
						$name_training = trim(substr($name_training, 3 , 255));
						$type_certificate = 1;
					}
					else if(substr($name_training,0,8)=='SEMINAR '){
						$name_training = str_replace('SEMINAR','',$name_training);
						$type_certificate = 2;
					}
					?>
					
					<?php
					$program = \backend\models\ProgramHistory::find()
					->where([
						'tb_program_id'=>$training->tb_program_id,
						'revision'=>$training->tb_program_revision,
					])
					->one();
					
					if(in_array($program->number,[
						'1.0.0.0',  //PRAJAB
						'2.0.0.0',
						'2.1.0.0',
						'2.2.0.0',
						'2.2.1.0',
						'2.2.2.0',
						'2.2.3.0',
					])){
						$type_certificate=1;
					}
					
					if(in_array($program->number,[
						'2.3.0.0',
						'2.3.1.0',
						'2.3.1.1',
						'2.3.1.2',
						'2.3.2.0',
						'2.6.0.0', // PENYEGARAN
					])){
						$type_certificate=0;
					}
					
					if(in_array($program->number,[
						'2.4.0.0',
						'2.5.0.0',
						'3.0.0.0',
					])){
						$type_certificate='';
					}
	
					echo Select2::widget([
						'name' => 'type_certificate', 
						'data' => [
							'0'=>'Sertifikat',
							'1'=>'Surat Tanda Tamat Pendidikan dan Pelatihan',
							'2'=>'Seminar',
						],
						'options' => [
							'placeholder' => 'type ...', 
							'class'=>'form-control',	
							'id' => 'select2-type_certificate'
						],
					]); ?>
					
					<?php 
					if(!empty($type_certificate)){
						$this->registerJs('
							$("#select2-type_certificate").select2().select2("val", '.$type_certificate.');
						');
					}
					?>
					</td>
				</tr>
				<tr>
					<td>Training Name</td>
					<td><?= Html::input( 'text', 'name_training', $name_training, ['class'=>'form-control'] ) ?></td>
				</tr>
				<tr>
					<td>Training Location</td>
					<td><?= Html::input( 'text', 'location_training', 'Jakarta', ['class'=>'form-control'] ) ?></td>
				</tr>
				<tr>
					<td>Signer</td>
					<td>
					<?php
					$ref_satker_id = Yii::$app->user->identity->employee->ref_satker_id;
					$modelEmployeeSigners = \backend\models\Employee::find()
							->where(
								'
								(ref_satker_id=:ref_satker_id AND position <> 5) 
									or 
								(position=1)',
								[
									':ref_satker_id'=>$ref_satker_id,
								]
							)
							->asArray()
							->all();
							
					$employeeSigners = [];
					foreach($modelEmployeeSigners as $modelEmployeeSigner){
						$employeeSigners[$modelEmployeeSigner['id']]=$modelEmployeeSigner['name'].' - '.$modelEmployeeSigner['positionDesc'];
					}					
					
					echo Select2::widget([
						'name' => 'signer', 
						'data' => $employeeSigners,
						'options' => [
							'placeholder' => 'signer ...', 
							'class'=>'form-control',	
						],
					]); 
					?>
					</td>
				</tr>
				<tr>
					<td>City Signer</td>
					<td><?= Html::input( 'text', 'city_signer', (strlen($training->satker->city)>2)?$training->satker->city:'Jakarta', ['class'=>'form-control'] ) ?></td>
				</tr>
				<tr>
					<td></td>
					<td><?= Html::submitButton('<i class="fa fa-print"></i> Print', ['class' => 'btn btn-primary']) ?></td>
				</tr>
				</table>

			<?php ActiveForm::end() ?>
			</div>
			<div class="col-md-6">
			
			<?php $form2 = ActiveForm::begin([
				'id' => 'print-form-2',
				'action' => ['print-backend-certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id],
				'options' => [
					'class' => 'form-horizontal',
				],
			]) ?>
				<?php //Html::input( $type, $name = null, $value = null, $options = [] ) ?>
				
				<table class="table table-condensed table-striped" style="width:90%;margin:10px auto;">
				<tr>
					<th colspan="2"><label>Backend Certificate</label></th>
				</tr>
				<tr>
					<td style="width:30%">Tanggal</td>
					<td>
					<?php 
					echo \kartik\widgets\DatePicker::widget([
						'name' => 'date',
						'type' => DatePicker::TYPE_COMPONENT_PREPEND,
						//'value' => '23-Feb-1982',
						'pluginOptions' => [
						'autoclose'=>true,
						'format' => 'dd-M-yyyy'
						]
						]); 
					?>
					</td>
				</tr>
				<tr>
					<td>Signer</td>
					<td>
					<?php
					$ref_satker_id = Yii::$app->user->identity->employee->ref_satker_id;
					$modelEmployeeSigners = \backend\models\Employee::find()
							->where(
								'
								(ref_satker_id=:ref_satker_id AND position <> 5) 
									or 
								(position=1)',
								[
									':ref_satker_id'=>$ref_satker_id,
								]
							)
							->asArray()
							->all();
							
					$employeeSigners = [];
					foreach($modelEmployeeSigners as $modelEmployeeSigner){
						$employeeSigners[$modelEmployeeSigner['id']]=$modelEmployeeSigner['name'].' - '.$modelEmployeeSigner['positionDesc'];
					}			
					echo Select2::widget([
						'name' => 'signer', 
						'data' => $employeeSigners,
						'options' => [
							'placeholder' => 'signer ...', 
							'class'=>'form-control',	
						],
					]); 
					?>
					</td>
				</tr>
				<tr>
					<td>City Signer</td>
					<td><?= Html::input( 'text', 'city_signer', (strlen($training->satker->city)>2)?$training->satker->city:'Jakarta', ['class'=>'form-control'] ) ?></td>
				</tr>
				<tr>
					<td></td>
					<td><?= Html::submitButton('<i class="fa fa-print"></i> Print', ['class' => 'btn btn-success']) ?></td>
				</tr>
				</table>

			<?php ActiveForm::end() ?>
			</div>
		</div>
	</div>
	
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
