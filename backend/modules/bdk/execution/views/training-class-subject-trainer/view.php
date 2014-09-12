<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

$this->title = $model->trainer->name;
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-trainer-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Class Subject Trainer # ' . $model->trainer->name,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back',[
								'index',
								'tb_training_class_subject_id' => (int)$tb_training_class_subject_id
							],
							[
								'class'=>'btn btn-xs btn-primary',
								'title'=>'Back to Index',
							]
						),
        'attributes' => [
            'id',
            [
				'attribute' => 'tb_trainer_id',
				'label' => 'Trainer',
				'value' => $model->trainer->name,
			],
            [
				'attribute' => 'ref_trainer_type_id',
				'label' => 'Type',
				'value' => $model->trainerType->name,
			],
            'cost',
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
