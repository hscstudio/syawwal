<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use hscstudio\heart\widgets\Box;
use kartik\datecontrol\DateControl;

/* @var $searchModel backend\models\TrainingClassSearch */

$this->title = 'Honor Persiapan Mengajar';
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
			/*[
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
			],*/
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
				'value' => function ($model) use ($sbu){	
					return '<span class="label label-default">'.number_format($sbu->value).'</span>';
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
				'value' => function ($model) use ($sbu){	
					$rc1 = explode('/',$model->trainer->rankClass->name);
					$gol='-';
					if(isset($rc1[1])){
						$rc2 = explode('.',$rc1[1]);
						$gol = trim($rc2[0]);
					}
					//[9]=[8]xGol.IV=15%, Gol.III=5%, Praktisi=5%x50%
					if($gol=='-' and empty($model->trainer->npwp)){ //Praktisi have NPWP 
						$pph=0.05*0.5*1.2;
					}
					else if($gol=='-'){
						$pph=0.05*0.5;
					}
					else if($gol=='III'){
						$pph=0.05;
					}
					else if($gol=='IV'){
						$pph=0.15;
					}					
					$total = (int)($pph*$sbu->value);
					return '<span class="label label-default">'.number_format($total).'</span>';
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
				'value' => function ($model)use($sbu){
					$rc1 = explode('/',$model->trainer->rankClass->name);
					$gol='-';
					if(isset($rc1[1])){
						$rc2 = explode('.',$rc1[1]);
						$gol = trim($rc2[0]);
					}
					//[9]=[8]xGol.IV=15%, Gol.III=5%, Praktisi=5%x50%
					if($gol=='-' and empty($model->trainer->npwp)){ //Praktisi have NPWP 
						$pph=0.05*0.5*1.2;
					}
					else if($gol=='-'){
						$pph=0.05*0.5;
					}
					else if($gol=='III'){
						$pph=0.05;
					}
					else if($gol=='IV'){
						$pph=0.15;
					}					
					$total_pph = (int)($pph*$sbu->value);
					$total = $sbu->value - $total_pph;
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
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Honor Persiapan Mengajar</h3>',
			'before'=>
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
					<li>Hanya pengajar yang mendapatkan honor persiapan mengajar</li>
				</ul>
				</div>
				<div class="col-md-4" style="text-align:right;">'.
				Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['prepare','tb_training_class_id'=>$trainingClass->id], ['class' => 'btn btn-info']).' '.
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
