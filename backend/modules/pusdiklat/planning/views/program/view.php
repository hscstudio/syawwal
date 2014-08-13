<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu']=$menus;
?>
<div class="program-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
	<!--
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	-->
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'Programs # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> '{delete}',
        'attributes' => [
            'id',
            [
				'attribute' => 'ref_satker_id',
				'value' => $model->satker->name
			],
			[
				'attribute' => 'number',
				'value' => $model->number . ' => '.$model->programCode->name,
			],            
            'name',
            'hours',
            'days',
            'test',
            'validationStatus',
            'validationNote',
            'status',
            'created',
            [
				'attribute' => 'createdBy',
				'value' => @$model->getUser($model->deletedBy)->username,
			],
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
