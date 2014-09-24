<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudentCertificate */

$this->title = 'View #'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training2/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class2/index','tb_training_id'=>$tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class Student', 'url' => ['index','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-student-view">
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Class Student # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            'id',
            [
				'attribute' => 'ref_religion_id',
				'value' => $model->religion->name,
			],
            [
				'attribute' => 'ref_graduate_id',
				'value' => $model->graduate->name,
			],
            [
				'attribute' => 'ref_rank_class_id',
				'value' => $model->rankClass->name,
			],
            [
				'attribute' => 'ref_unit_id',
				'value' => $model->unit->name,
			],
            'name',
            'nickName',
            'frontTitle',
            'backTitle',
            'nip',
            //'password_hash',
            //'auth_key',
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
