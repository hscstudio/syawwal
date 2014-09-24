<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="student-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Students # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' ',
        'attributes' => [
            'id',
            [
				'attribute' => 'ref_religion_id',
				'value' => $model->religion->name,
			],
            'ref_religion_id',
            [
				'attribute' => 'ref_graduate_id',
				'value' => $model->graduate->name,
			],
            'ref_graduate_id',
            [
				'attribute' => 'ref_rank_class_id',
				'value' => $model->rankClass->name,
			],
            'ref_rank_class_id',
            [
				'attribute' => 'ref_unit_id',
				'value' => $model->unit->name,
			],
            'ref_unit_id',
            'name',
            'nickName',
            'frontTitle',
            'backTitle',
            'nip',
            'password_hash',
            'auth_key',
            'born',
            'birthDay',
            'gender',
            'phone',
            'email:email',
            'address',
            'married',
            [
				'attribute' => 'photo',
				'format' => 'html',
				'value' => '<img src='.\yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/thumb_'.$model->photo]).'>',
			],
            'blood',
            'position',
            'positionDesc',
            'education',
            'eselon2',
            'eselon3',
            'eselon4',
            'satker',
            'officePhone',
            'officeFax',
            'officeEmail:email',
            'officeAddress',
            'noSKPangkat',
            'tmtSKPangkat',
			[
				'attribute' => 'fileSKPangkat',
				'format' => 'html',
				'value' => '<a href='.\yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/'.$model->fileSKPangkat]).'>Download</a>',
			],
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
