<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu']=$menus;
?>
<div class="student-view">

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
			'heading'=>'Students # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
        'attributes' => [
            'id',
            [
				'attribute' => 'ref_religion_id',
				'value' => function ($model) {
					return $model->religion->name;
				}
			],
            'ref_religion_id',
            [
				'attribute' => 'ref_graduate_id',
				'value' => function ($model) {
					return $model->graduate->name;
				}
			],
            'ref_graduate_id',
            [
				'attribute' => 'ref_rank_class_id',
				'value' => function ($model) {
					return $model->rankClass->name;
				}
			],
            'ref_rank_class_id',
            [
				'attribute' => 'ref_unit_id',
				'value' => function ($model) {
					return $model->unit->name;
				}
			],
            'ref_unit_id',
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
            'eselon2',
            'eselon3',
            'eselon4',
            'officePhone',
            'officeFax',
            'officeEmail:email',
            'officeAddress',
            'noSKPangkat',
            'tmtSKPangkat',
            'fileSKPangkat',
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
