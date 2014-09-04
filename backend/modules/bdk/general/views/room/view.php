<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use backend\models\Employee;
use backend\models\Satker;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

// Ngeformat status
switch ($model->status)
{
    case 1:
        $icon = 'eye';
        $text = 'Published';
        $label = 'success';
        break;
    case 0:
        $icon = 'eye-slash';
        $text = 'Hidden';
        $label = 'danger';
        break;
    default:
        $icon = 'exclamation-circle';
        $text = 'Error';
        $label = 'warning';
}
$statusOlahan = '<div class="label label-'.$label.'" ><i class="fa fa-fw fa-'.$icon.'"></i>'.$text.'</div>';
// dah

// Ngeformat created & modified
$created = date('d F Y (H:i:s)', strtotime($model->created));
$modified = date('d F Y (H:i:s)', strtotime($model->modified));

// Ngeformat createdBy & modifiedBy
$createdBy = Employee::findOne($model->createdBy)->name;
$modifiedBy = Employee::findOne($model->modifiedBy)->name;

// Ngeformat satker
$satker = Satker::findOne($model->ref_satker_id)->name;

// Ngeformat hostel dan reguler
$owner = ($model->owner === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';
$computer = ($model->computer === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';
$hostel = ($model->hostel === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';

?>

<div class="room-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Room ' . $model->name,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back',['index', 'status' => $model->status],
						['class'=>'btn btn-xs btn-default',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> Deleted',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            [
				'attribute' => 'ref_satker_id',
				'value' => $satker,
			],
            'code',
            'name',
            'capacity',
            [
                'attribute' => 'owner',
                'format' => 'raw',
                'value' => $owner
            ],
            [
                'attribute' => 'computer',
                'format' => 'raw',
                'value' => $computer
            ],
            [
                'attribute' => 'hostel',
                'format' => 'raw',
                'value' => $hostel
            ],
            'address',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $statusOlahan
            ],
            [
                'attribute' => 'owner',
                'format' => 'raw',
                'value' => $owner
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
