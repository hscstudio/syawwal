<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudentCertificate */

$this->title = 'View #'.$model->tb_training_class_student_id;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training2/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class2/index','tb_training_id'=>$tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => 'Training Certificates', 'url' => ['certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-student-certificate-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Class Student Certificates # ' . $model->tb_training_class_student_id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            /*
			[ 
                'attribute' => 'tb_training_class_student_id', 
                'value' => $model->trainingClassStudent->name, 
            ],
            'tb_training_class_student_id',
            [ 
                'attribute' => 'ref_unit_id', 
                'value' => $model->unit->name, 
            ],
            'ref_unit_id',
            [ 
                'attribute' => 'ref_graduate_id', 
                'value' => $model->graduate->name, 
            ],
            'ref_graduate_id',
            [ 
                'attribute' => 'ref_rank_class_id', 
                'value' => $model->rankClass->name, 
            ],
            'ref_rank_class_id',*/
            'number',
            'seri',
            'date',
            'position',
            'positionDesc',
            'education',
            'eselon2',
            'eselon3',
            'eselon4',
            'satker',
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
