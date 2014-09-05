<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use backend\models\ActivityRoom;

/* @var $searchModel backend\models\TrainingSearch */

$this->title = 'Trainings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-index">

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
				'attribute' => 'name',
				'format'=>'raw',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::tag('span', $data->name, ['title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				},
			],
            
            
			[
				'attribute' => 'start',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return date('d M y',strtotime($data->start));
				}
			],
		
			[
				'class' => 'kartik\grid\DataColumn',
				'attribute' => 'finish',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				//'editableOptions'=>['header'=>'Finish', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]],
				'value' => function ($data) {
					return date('d M y',strtotime($data->finish));
				}
			],
       
            
			[
				'class' => 'kartik\grid\DataColumn',
				'attribute' => 'studentCount',
				'label'=> 'Student',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'class' => 'kartik\grid\DataColumn',
				'attribute' => 'classCount',
				'label'=> 'Class',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'label' => 'Room',
				'value' => function ($data)
				{
					if($data->status==2){
						$roomCount = ActivityRoom::find()->where(['type' => 0, 'activity_id' => $data->id])->count();
						if($roomCount==0){ 
							return Html::a('SET', ['room','activity_id'=>$data->id], ['class' => 'label label-warning','data-pjax'=>0]);
						}		
						else{
							return Html::a($roomCount, ['room','activity_id'=>$data->id], ['class' => 'label label-primary','data-pjax'=>0]);
						}
					}
					else{
						return "-";
					}
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
				'value' => function ($data) use ($year){					
					if ($data->status==1){
						$icon='<span class="glyphicon glyphicon-check"></span>';
						$label='label label-info';
						$title='READY';
					}	
					else if ($data->status==2){ 
						$icon='<span class="glyphicon glyphicon-refresh"></span>';
						$label='label label-success';
						$title='EXECUTE';
					}
					else if ($data->status==3){ 
						$icon='<span class="glyphicon glyphicon-trash"></span>';
						$label='label label-danger';
						$title='CANCEL';
					}
					else {
						$icon='<span class="glyphicon glyphicon-fire"></span>';
						$label='label label-warning';
						$title='PLAN';
					}
					return Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				}
			],
            [
				'class' => 'kartik\grid\ActionColumn',
				'template' => '{view} {update}',
				'buttons' => [
					'update' => function ($url, $model) {
								$icon='<span class="glyphicon glyphicon-pencil"></span>';
								return ($model->status!=2 AND $model->status!=1)?'':Html::a($icon,$url,[
									'data-pjax'=>"0",
								]);
							},
				],			
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>'-',
			'after'=>'
				<div class="row">
				<div class="col-md-8">
				Keterangan:<br>
				<ul>
					<li>Student = Jumlah rencana peserta diklat</li>
					<li>Class = Jumlah class yang dibutuhkan</li>
					<li>Room = Jumlah room yang telah dipesan</li>
				</ul>
				</div>
				<div class="col-md-4" style="text-align:right;">'.
				Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']).
				'</div>
				</div>',	
			'showFooter'=>true,
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	<?php echo \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']); ?>
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
