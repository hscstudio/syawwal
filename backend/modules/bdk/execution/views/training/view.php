<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use backend\models\Employee;
use backend\models\Training;
use backend\models\Satker;
use backend\models\Program;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

// Ngeformat status
switch ($model->status)
{
    case 1:
        $icon = 'check-square-o';
        $text = 'Ready';
        $label = 'info';
        break;
    case 2:
        $icon = 'refresh';
        $text = 'Execute';
        $label = 'success';
        break;
    case 3:
        $icon = 'trash-o';
        $text = 'Ready';
        $label = 'danger';
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

// Ngeformat tgl diklat
$start = date('d F Y', strtotime($model->start));
$finish = date('d F Y', strtotime($model->finish));

// Ngeformat satker
$satker = Satker::findOne($model->ref_satker_id)->name;

// Ngeformat program
$program = Program::findOne($model->tb_program_id)->name.' <span class="label label-default">Rev '.$model->tb_program_revision.'</span>';

// Ngeformat hostel dan reguler
$hostel = (Training::findOne($model->id)->hostel === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';
$reguler = (Training::findOne($model->id)->reguler === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';
?>

<div class="training-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Trainings # ' . $model->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back to Training',['index', 'status' => $model->status],
						['class'=>'btn btn-xs btn-primary'
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i> Delete',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            [
                'attribute' => 'tb_program_id',
                'format' => 'raw',
                'value' => $program
            ],
            [
                'attribute' => 'ref_satker_id',
                'format' => 'raw',
                'value' => $satker
            ],
            'name',
            [
                'attribute' => 'start',
                'format' => 'raw',
                'value' => $start
            ],
            [
                'attribute' => 'finish',
                'format' => 'raw',
                'value' => $finish
            ],
            'note',
            'studentCount',
            'classCount',
            'executionSK',
            'resultSK',
            'costPlan',
            'costRealisation',
            'sourceCost',
            [
                'attribute' => 'hostel',
                'format' => 'raw',
                'value' => $hostel
            ],
            [
                'attribute' => 'reguler',
                'format' => 'raw',
                'value' => $reguler
            ],
            'stakeholder',
            'location',
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
            'approvedStatus',
            'approvedStatusNote',
            'approvedStatusDate',
            'approvedStatusBy',
        ],
    ]) ?>

</div>
