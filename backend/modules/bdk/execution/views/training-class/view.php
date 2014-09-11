<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use backend\models\Employee;

$this->title = 'Detail View: ' . ' ' . $model->class;
$this->params['breadcrumbs'][] = ['label' => 'Training', 'url' => ['training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Class', 'url' => ['index', 'trainingId' => $trainingId]];
$this->params['breadcrumbs'][] = $model->class;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

// Ngeformat status
switch ($model->status)
{
    case 0:
        $icon = 'eye-slash';
        $text = 'Hidden';
        $label = 'default';
        break;
    case 1:
        $icon = 'eye';
        $text = 'Published';
        $label = 'success';
        break;
    default:
        $icon = 'exclamation-circle';
        $text = 'Error';
        $label = 'default';
}
$statusOlahan = '<div class="label label-'.$label.'" ><i class="fa fa-fw fa-'.$icon.'"></i>'.$text.'</div>';
// dah

// Ngeformat created & modified
$created = date('d F Y (H:i:s)', strtotime($model->created));
$modified = date('d F Y (H:i:s)', strtotime($model->modified));

// Ngeformat createdBy & modifiedBy
$createdBy = Employee::findOne($model->createdBy)->name;
$modifiedBy = Employee::findOne($model->modifiedBy)->name;

?>
<div class="training-class-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Class - ' . $model->class,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back',['index', 'trainingId' => $trainingId],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> Delete',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            [
				'attribute' => 'tb_training_id',
				'value' => $model->training->name,
			],
            'class',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $statusOlahan
            ],
            [
                'attribute' => 'created',
                'format' => 'raw',
                'value' => $created
            ],
            [
                'attribute' => 'createdBy',
                'format' => 'raw',
                'value' => $createdBy
            ],
            [
                'attribute' => 'modified',
                'format' => 'raw',
                'value' => $modified
            ],
            [
                'attribute' => 'modifiedBy',
                'format' => 'raw',
                'value' => $modifiedBy
            ],
        ],
    ]) ?>

</div>
