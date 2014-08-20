<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramCode */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Program Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="program-code-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Program Codes # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i>',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            //'id',
			[
				'attribute' => 'parent_id',
				'value' =>  $model->parent_id==0?'----' : \backend\models\ProgramCode::findOne($model->parent_id)->name,
			],
            'name',
            'code',
           // 'parent_id',
            [
				'attribute' => 'status',
				'value' => $model->status == '0'?'Off':'On',
			],
            /*'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',*/
        ],
    ]) ?>

</div>
