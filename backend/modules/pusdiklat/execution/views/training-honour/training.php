<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use hscstudio\heart\widgets\Box;
use kartik\datecontrol\DateControl;
use kartik\widgets\Select2;
use \backend\models\TrainingScheduleTrainer;
use \backend\models\TrainingSchedule;
/* @var $searchModel backend\models\TrainingClassSearch */

$this->title = 'Honor Mengajar';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['./training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Honours : '.\yii\helpers\Inflector::camel2words($trainingClass->training->name), 'url' => \yii\helpers\Url::to(['index','tb_training_id'=>$trainingClass->tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => 'Class : '.$trainingClass->class, 'url' => ['index','tb_training_id'=>$trainingClass->tb_training_id]];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <?= GridView::widget([
		'id'=>'gridview-prepare',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'tb_training_schedule_id',
				'format' => 'raw',
				'label' => 'Subject',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){
					$programSubjectId = $model->trainingSchedule->trainingClassSubject->tb_program_subject_id;
					$program_revision = $model->trainingSchedule->trainingClass->training->tb_program_revision;
					$programSubjects=\backend\models\ProgramSubjectHistory::find()
						->where([
							'tb_program_subject_id'=>$programSubjectId,
							'revision'=>$program_revision,
							'status'=>1
						])
						->one();
					$subjectType=backend\models\SubjectType::find()
						->where(['id'=>$programSubjects->ref_subject_type_id])
						->one();
					return '<span class="label label-default">'.$subjectType->name.'</span> '.$programSubjects->name;
				}
			],
			
			[
				'attribute' => 'tb_trainer_id',
				'format' => 'raw',
				'label' => 'Trainer',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){					
					return $model->trainer->name;
				}
			],
			[
				'format' => 'raw',
				'label' => 'Organization',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'150px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){					
					return $model->trainer->organization;
				}
			],
			[
				'label' => 'Type',
				'format' => 'raw',
				'width' => '150px',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){					
					return ' <span class="label label-default">'.$model->trainerType->name.'</span> ';
				}
			],
			[
				'label' => 'Gol',
				'format' => 'raw',
				'width' => '50px',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){
					$rc1 = explode('/',$model->trainer->rankClass->name);
					$gol='-';
					if(isset($rc1[1])){
						$rc2 = explode('.',$rc1[1]);
						$gol = trim($rc2[0]);
					}
					
					return '<span class="label label-default">'.$gol.'</span>';
				}
			],
			[
				'label' => 'Tarif',
				'format' => 'raw',
				'width' => '100px',
				'vAlign'=>'middle',
				'hAlign'=>'right',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) use ($sbus){	
					$tarif =0;
					$info = "NON PNS (TANPA NIP) TAPI TARIF TIDAK DISET";
					if($model->cost>0){
						//PRAKTISI
						$info = "TARIF PRAKTISI";
						$tarif = $model->cost;
					}
					else{
						// DETECT NIP FOR PNS
						if(strlen($model->trainer->nip)>=9){
							// DETECT INTERNAL BPPK
							if(null != $model->trainer->employee){
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$info = "TARIF PENGAJAR INTERNAL BPPK";
									$tarif = $sbus['honor_pengajar_pns_internal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$info = "TARIF ASISTEN INTERNAL BPPK";
									$tarif = $sbus['honor_asisten_pns_internal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$info = "TARIF PENCERAMAH ESELON 1 INTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_internal_1'];
									}
									else if($model->trainer->eselon==2){
										$info = "TARIF PENCERAMAH ESELON 2 INTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_internal_2'];
									}
									else{
										$info = "TARIF PENCERAMAH BIASA INTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_internal_3'];
									}									
								}
							}
							else{
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$info = "TARIF PENGAJAR INTERNAL BPPK";
									$tarif = $sbus['honor_pengajar_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$info = "TARIF ASISTEN INTERNAL BPPK";
									$tarif = $sbus['honor_asisten_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$info = "TARIF PENCERAMAH ESELON 1 EKSTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_eksternal_1'];
									}
									else if($model->trainer->eselon==2){
										$info = "TARIF PENCERAMAH ESELON 2 EKSTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_eksternal_2'];
									}
									else{
										$info = "TARIF PENCERAMAH BIASA EKSTERNAL BPPK";
										$tarif = $sbus['honor_penceramah_pns_eksternal_3'];
									}	
								}
							}
						}
					}
					return '<span class="label label-default" title="'.$info.'" id="tarif_'.$model->id.'">'.number_format($tarif).'</span>';
				}
			],
			[
				'label' => 'JP',
				'format' => 'raw',
				'width' => '100px',
				'vAlign'=>'middle',
				'hAlign'=>'right',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) use ($sbus){
					$tst = TrainingScheduleTrainer::find()
						->select('*, SUM(hours) as JP')
						->joinWith(['trainer', 'trainer.employee','trainingSchedule'])
						->where([
							'tb_training_schedule_id'=>TrainingSchedule::find()
								->select('id')
								->where([
									'tb_training_class_id'=>$model->trainingSchedule->tb_training_class_id,
									'tb_training_class_subject_id'=>$model->trainingSchedule->tb_training_class_subject_id,
									'status'=>1,					
								])
								->column(),
							TrainingScheduleTrainer::tableName().'.status'=>1,
							TrainingScheduleTrainer::tableName().'.tb_trainer_id'=>$model->tb_trainer_id,
						])
						->asArray()
						->one();						
					return '<span class="label label-default">'.($tst['JP']).'</span>';
				}
			],
			[
				'label' => 'PPh',
				'format' => 'raw',
				'width' => '100px',
				'vAlign'=>'middle',
				'hAlign'=>'right',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model) use ($sbus){
					// GETTING TARIF
					$tarif =0;
					if($model->cost>0){
						//PRAKTISI
						$tarif = $model->cost;
					}
					else{
						// DETECT NIP FOR PNS
						if(strlen($model->trainer->nip)>=9){
							// DETECT INTERNAL BPPK
							if(null != $model->trainer->employee){
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$tarif = $sbus['honor_pengajar_pns_internal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$tarif = $sbus['honor_asisten_pns_internal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$tarif = $sbus['honor_penceramah_pns_internal_1'];
									}
									else if($model->trainer->eselon==2){
										$tarif = $sbus['honor_penceramah_pns_internal_2'];
									}
									else{
										$tarif = $sbus['honor_penceramah_pns_internal_3'];
									}									
								}
							}
							else{
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$tarif = $sbus['honor_pengajar_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$tarif = $sbus['honor_asisten_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$tarif = $sbus['honor_penceramah_pns_eksternal_1'];
									}
									else if($model->trainer->eselon==2){
										$tarif = $sbus['honor_penceramah_pns_eksternal_2'];
									}
									else{
										$tarif = $sbus['honor_penceramah_pns_eksternal_3'];
									}	
								}
							}
						}
					}
					// GETTING TARIF
					
					// GETTING TOTAL JP
					$tst = TrainingScheduleTrainer::find()
						->select('*, SUM(hours) as JP')
						->joinWith(['trainer', 'trainer.employee','trainingSchedule'])
						->where([
							'tb_training_schedule_id'=>TrainingSchedule::find()
								->select('id')
								->where([
									'tb_training_class_id'=>$model->trainingSchedule->tb_training_class_id,
									'tb_training_class_subject_id'=>$model->trainingSchedule->tb_training_class_subject_id,
									'status'=>1,					
								])
								->column(),
							TrainingScheduleTrainer::tableName().'.status'=>1,
							TrainingScheduleTrainer::tableName().'.tb_trainer_id'=>$model->tb_trainer_id,
						])
						->asArray()
						->one();	
					$jp = $tst['JP'];
					// GETTING TOTAL JP
					
					// GETTING PPH
					$rc1 = explode('/',$model->trainer->rankClass->name);
					$gol='-';
					if(isset($rc1[1])){
						$rc2 = explode('.',$rc1[1]);
						$gol = trim($rc2[0]);
					}
					//[9]=[8]xGol.IV=15%, Gol.III=5%, Praktisi=5%x50%
					$as = "-";
					if($gol=='-' and empty($model->trainer->npwp)){ //Praktisi have NPWP 
						$pph=0.05*0.5*1.2;
						$as = 'Praktisi Tanpa NPWP';
					}
					else if($gol=='-'){
						$pph=0.05*0.5;
						$as = 'Praktisi Ber-NPWP';
					}
					else if($gol=='III'){
						$pph=0.05;
						$as = 'PNS Gol III';
					}
					else if($gol=='IV'){
						$pph=0.15;
						$as = 'PNS Gol IV';
					}	
					// GETTING PPH
					
					$total_pph = (int)($pph*$tarif*$jp);
					return '<span class="label label-default" title="'.$pph.' '.$as.'" id="jp_'.$model->id.'">'.number_format($total_pph).'</span>';
				}
			],
			[
				'label' => 'Total',
				'format' => 'raw',
				'width' => '100px',
				'vAlign'=>'middle',
				'hAlign'=>'right',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model)use($sbus){
					// GETTING TARIF
					$tarif =0;
					if($model->cost>0){
						//PRAKTISI
						$tarif = $model->cost;
					}
					else{
						// DETECT NIP FOR PNS
						if(strlen($model->trainer->nip)>=9){
							// DETECT INTERNAL BPPK
							if(null != $model->trainer->employee){
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$tarif = $sbus['honor_pengajar_pns_internal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$tarif = $sbus['honor_asisten_pns_internal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$tarif = $sbus['honor_penceramah_pns_internal_1'];
									}
									else if($model->trainer->eselon==2){
										$tarif = $sbus['honor_penceramah_pns_internal_2'];
									}
									else{
										$tarif = $sbus['honor_penceramah_pns_internal_3'];
									}									
								}
							}
							else{
								// DETECT TRAINER TYPE
								if($model->ref_trainer_type_id==0){ // PENGAJAR
									$tarif = $sbus['honor_pengajar_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==1){ // ASISTEN
									$tarif = $sbus['honor_asisten_pns_eksternal'];
								}
								else if($model->ref_trainer_type_id==2){ // PENCERAMAH
									// CHECK ESELON
									if($model->trainer->eselon==1){
										$tarif = $sbus['honor_penceramah_pns_eksternal_1'];
									}
									else if($model->trainer->eselon==2){
										$tarif = $sbus['honor_penceramah_pns_eksternal_2'];
									}
									else{
										$tarif = $sbus['honor_penceramah_pns_eksternal_3'];
									}	
								}
							}
						}
					}
					// GETTING TARIF
					
					// GETTING TOTAL JP
					$tst = TrainingScheduleTrainer::find()
						->select('*, SUM(hours) as JP')
						->joinWith(['trainer', 'trainer.employee','trainingSchedule'])
						->where([
							'tb_training_schedule_id'=>TrainingSchedule::find()
								->select('id')
								->where([
									'tb_training_class_id'=>$model->trainingSchedule->tb_training_class_id,
									'tb_training_class_subject_id'=>$model->trainingSchedule->tb_training_class_subject_id,
									'status'=>1,					
								])
								->column(),
							TrainingScheduleTrainer::tableName().'.status'=>1,
							TrainingScheduleTrainer::tableName().'.tb_trainer_id'=>$model->tb_trainer_id,
						])
						->asArray()
						->one();	
					$jp = $tst['JP'];
					// GETTING TOTAL JP
					
					// GETTING PPH
					$rc1 = explode('/',$model->trainer->rankClass->name);
					$gol='-';
					if(isset($rc1[1])){
						$rc2 = explode('.',$rc1[1]);
						$gol = trim($rc2[0]);
					}
					//[9]=[8]xGol.IV=15%, Gol.III=5%, Praktisi=5%x50%
					$as = "-";
					if($gol=='-' and empty($model->trainer->npwp)){ //Praktisi have NPWP 
						$pph=0.05*0.5*1.2;
						$as = 'Praktisi Tanpa NPWP';
					}
					else if($gol=='-'){
						$pph=0.05*0.5;
						$as = 'Praktisi Ber-NPWP';
					}
					else if($gol=='III'){
						$pph=0.05;
						$as = 'PNS Gol III';
					}
					else if($gol=='IV'){
						$pph=0.15;
						$as = 'PNS Gol IV';
					}	
					// GETTING PPH
					
					$total_pph = (int)($pph*$tarif*$jp);
					$total = $tarif*$jp - $total_pph;
					return '<span class="label label-default">'.number_format($total).'</span>';
				}
			],
			['class' => 'kartik\grid\CheckboxColumn']
        ],
		'beforeHeader'=>[
			[
				'columns'=>[
					['content'=>'', 'options'=>['colspan'=>5, 'class'=>'text-center warning']], 
					['content'=>'', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
					['content'=>'', 'options'=>['colspan'=>1, 'class'=>'text-center warning']], 
				],
			]
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Honor Mengajar</h3>',
			'before'=>
				'<div class="pull-right" style="margin-right:5px;">'.
				/*Select2::widget([
					'name' => 'status', 
					'data' => ['all'=>'All','0'=>'Plan','1'=>'Ready','2'=>'Execute','3'=>'Cancel'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/training/index']).'?year='.$year.'&status="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1000,
							});
						',	
					],
				]).*/
				'</div>'.
				'<div class="clearfix"></div>
				<div class="row" style="margin-top:10px">
				<div class="col-md-8">'.
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back', \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-honour/index','tb_training_id'=>$trainingClass->tb_training_id]), ['class' => 'btn btn-warning']).' '.
				'</div>
				<div class="col-md-4">
					'.
					'<div class="form-group" style="width:200px;">
						<input type="text" id="number-honour" class="form-control" name="number-honour" placeholder="Number">
					</div>'.
					'<div style="width:200px;">'.
					DateControl::widget([
						'name'=>'honour-date', 
						'type'=>DateControl::FORMAT_DATE,
						'value'=>date('Y-m-d'),
						'options'=>[
							'pluginOptions'=>[
								'autoclose'=>true,
							]
						]
					]).
					'</div>'.
					'
				</div>
				</div>',
				
			'beforeOptions'=>[],
			'after'=>'
				<div class="row">
				<div class="col-md-8">
				Keterangan:<br>
				<ul>
					<li>Hanya untuk honor transport dalam kota</li>
				</ul>
				</div>
				<div class="col-md-4" style="text-align:right;">'.
				Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['transport','tb_training_class_id'=>$trainingClass->id], ['class' => 'btn btn-info']).' '.
				'<button type="button" class="btn btn-primary" onclick="var keys = $(\'#gridview-prepare\').yiiGridView(\'getSelectedRows\').length; alert(keys > 0 ? \'Downloaded \' + keys + \' selected books to your account.\' : \'No rows selected for download.\');"><i class="fa fa-print"></i> Print Selected</button>'.' '.
				'</div>
				</div>',
			'showFooter'=>true
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
