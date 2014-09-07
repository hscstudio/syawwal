<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap\Dropdown;

$this->title = 'Room Request Center';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="list-room-index">

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
	            ['class' => 'kartik\grid\SerialColumn'],
            
				[
					'attribute' => 'code',
					'vAlign'=>'middle',
					'width' => '100px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
            
				[
					'attribute' => 'name',
					'label' => 'Room Name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],

				[
					'label' => 'Request Pending',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'format' => 'raw',
					'width' => '80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'value' => function ($data) {
						$countRoom = $data->getActivityRooms()->andWhere(['status' => 0])->count();
						if ($countRoom > 0) {
							return '
							<div class="btn-group">
								<div class="btn btn-xs btn-warning" disabled="disabled"><strong>'.$countRoom.'</strong></div>
								<a class="btn btn-xs btn-primary" href="'.Url::to(['index', 'roomId' => $data->id]).'">
									<i class="fa fa-fw fa-eye"></i>
								</a>
							</div>';
						}
						else {
							return '
							<div class="btn-group">
								<div class="btn btn-xs btn-default" disabled="disabled"><strong>'.$countRoom.'</strong></div>
								<a class="btn btn-xs btn-primary" href="'.Url::to(['index', 'roomId' => $data->id]).'">
									<i class="fa fa-fw fa-calendar"></i>
								</a>
							</div>';
						}
					}
				],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'after'=>Html::a('<i class="fa fa-fw fa-calendar"></i> Visualize All Request', ['index', 'roomId' => 'all'], ['class' => 'btn btn-primary']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>


	<?php
		echo \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']);
	?>

</div>
