<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use backend\models\Employee;
use backend\models\Training;
use backend\models\Satker;
use backend\models\Program;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => Url::to(['training/index'])];
$this->params['breadcrumbs'][] = ['label' => 'History', 'url' => Url::to(['training-history/index', 'tb_training_id' => $model->tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Rev '.$model->revision;
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

// Ngeformat nama training plus include revision
$name = $model->name.' <span class="label label-default">Rev '.$model->revision.'</span>';

// Ngeformat hostel dan reguler
$hostel = ($model->hostel === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';
$reguler = ($model->reguler === 0) ? '<span class="label label-danger">No</span>' : '<span class="label label-success">Yes</span>';


?>
<div class="training-history-view">

    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> Detail History',
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back to List History of '.$model->training->name,['index', 'tb_training_id' => $model->tb_training_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            [
                'attribute' => 'tb_program_id',
                'format' => 'raw',
                'label' => 'Program',
                'value' => $program
            ],
            [
                'attribute' => 'ref_satker_id',
                'format' => 'raw',
                'label' => 'Satker',
                'value' => $satker
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'label' => 'Name',
                'value' => $name
            ],
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
