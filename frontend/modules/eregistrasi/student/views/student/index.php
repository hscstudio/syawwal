<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel frontend\models\StudentSearch */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="student-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            	            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
				
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nip',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Nip', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'nickName',
					//'pageSummary' => 'Page Total',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'NickName', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'format' => 'html',
					'attribute' => 'data_diklat',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					//'pageSummary' => 'Page Total',
					'value' => function ($data) {
						$countSubject = \frontend\models\TrainingClassStudent::find()
									->where(['tb_student_id' => $data->id,])
									->active()
									->count();
						if($countSubject>0){
							return Html::a($countSubject, ['training-class-student/index','tb_student_id'=>$data->id], ['class' => 'label label-success']);
						}
						else{
							return Html::a('Null', ['training-class-student/index','tb_student_id'=>$data->id], ['class' => 'label label-success']);
						}
					}
				],
            				
            	[
				 	'class' => 'kartik\grid\ActionColumn',
					'template' => '{update} {view}',
				],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Student</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			//'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Student', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	

</div>
