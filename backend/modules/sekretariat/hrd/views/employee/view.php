<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu']=$menus;
?>
<div class="employee-view">

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
			'heading'=>'Employees # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
        'attributes' => [
            'id',
            'ref_satker_id',
            [
				'attribute' => 'ref_unit_id',
				'value' => $model->unit->name
			],
            'ref_sta_unit_id',
            'name',
            'nickName',
            'frontTitle',
            'backTitle',
            'nip',
            'born',
            'birthDay',
            'gender',
            'phone',
            'email:email',
            'address',
            'married',
            'photo',
            'blood',
            'position',
            'education',
            'officePhone',
            'officeFax',
            'officeEmail:email',
            'officeAddress',
            'document1',
            'document2',
            'status',
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
            'deleted',
            'deletedBy',
        ],
    ]) ?>

</div>
