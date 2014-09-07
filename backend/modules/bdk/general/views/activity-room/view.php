<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use backend\models\Employee;

$this->title = $modelActivityRoom->training->name;
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

// Ngeformat type
switch ($modelActivityRoom->type) {
    case 0:
        $type = 'Training';
        break;
    case 1:
        $type = 'Meeting';
        break;
    
    default:
        $type = '<span class="alert alert-warning">Request type not recognized!</span>';
        break;
}

// Ngeformat nama activity
if ($modelActivityRoom->type == 0) {
    $activityName = $modelActivityRoom->training->name;
}
if ($modelActivityRoom->type == 1) {
    $activityName = 'Meeting will be added soon';
}

// Ngeformat status
switch ($modelActivityRoom->status)
{
    case 0:
        $icon = 'history';
        $text = 'Waiting for approval';
        $label = 'warning';
        break;
    case 2:
        $icon = 'check-circle';
        $text = 'Approved';
        $label = 'success';
        break;
    case 3:
        $icon = 'trash-o';
        $text = 'Rejected';
        $label = 'danger';
        break;
    default:
        $icon = 'exclamation-circle';
        $text = 'Error';
        $label = 'default';
}
$statusOlahan = '<div class="label label-'.$label.'" ><i class="fa fa-fw fa-'.$icon.'"></i>'.$text.'</div>';

// Ngeformat modifiedBy
$modifiedBy = Employee::findOne($modelActivityRoom->createdBy)->name;

?>
<div class="activity-room-view">

    <div class="row" style="margin:0 0 10px 0;">
        <?php
            echo '<div class="col-md-4"><center>';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 0);
            echo Html::submitButton('<i class="fa fa-fw fa-history"></i>Revert', ['class' => 'btn btn-default']);
            echo Html::endForm();
            echo '</center></div>';

            echo '<div class="col-md-4"><center>';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 2);
            echo Html::submitButton('<i class="fa fa-fw fa-check-circle"></i>Approve', ['class' => 'btn btn-success']);
            echo Html::endForm();
            echo '</center></div>';

            echo '<div class="col-md-4"><center>';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 3);
            echo Html::submitButton('<i class="fa fa-fw fa-times-circle"></i>Reject', ['class' => 'btn btn-danger']);
            echo Html::endForm();
            echo '</center></div>';
        ?>
    </div>

    <?= DetailView::widget([
        'model' => $modelActivityRoom,
		'mode'=> DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> ',
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back',['index', 'roomId' => $modelActivityRoom->tb_room_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]),
        'attributes' => [
            [
                'attribute' => 'type',
                'value' => $type
            ],
            [
                'attribute' => 'activity_id',
                'value' => $activityName
            ],
            [
                'attribute' => 'tb_room_id',
                'value' => $modelActivityRoom->room->name
            ],
            [
                'attribute' => 'startTime',
                'value' => date('D, d M Y (H:i:s)', strtotime($modelActivityRoom->startTime))
            ],
            [
                'attribute' => 'finishTime',
                'value' => date('D, d M Y (H:i:s)', strtotime($modelActivityRoom->finishTime))
            ],
            'note',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => $statusOlahan
            ],
            [
                'attribute' => 'modifiedBy',
                'value' => $modifiedBy 
            ],
        ],
    ]) ?>

</div>
