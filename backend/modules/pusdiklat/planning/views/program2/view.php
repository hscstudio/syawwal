<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */

$this->title = \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Programs # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            //'id',
            [
				'attribute' => 'ref_satker_id',
				'value' => $model->satker->name,
				'label' => 'Satker',
			],
           // 'ref_satker_id',
            'number',
            'name',
            'hours',
            'days',
            //'test',
			[
				'attribute' => 'test',
				'value' => $model->test == '0'?'Off':'On',
			],
            //'type',
			[
				'attribute' => 'type',
				'value' => $model->type == '0'?'Lulus':'Mengikuti',
			],
            'note',
            'validationStatus',
            'validationNote',
            //'status',
			[
				'format' => 'html',
				'attribute' => 'status',
				'value' => Html::a(($model->status==1)?'<span class="glyphicon glyphicon-ok"></span> Published':'<span class="glyphicon glyphicon-remove"></span> Unpublished', 
							'#', [
								'class'=>($model->status==1)?'label label-info':'label label-warning',
							]),
			],
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
