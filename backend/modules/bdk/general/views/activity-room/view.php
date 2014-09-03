<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;

$this->title = $modelActivityRoom->training->name;
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="activity-room-view">

    <?= DetailView::widget([
        'model' => $modelActivityRoom,
		'mode'=> DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Activity Rooms # ' . $modelActivityRoom->training->id,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i>',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => [
            'id',
            'type',
            'activity_id',
            'tb_room_id',
            'startTime',
            'finishTime',
            'note',
            'status',
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
        ],
    ]) ?>

    <div class="row">
        <?php
            echo '<div class="col-md-3">';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 0);
            echo Html::submitButton('<i class="fa fa-fw fa-history"></i>Revert', ['class' => 'btn btn-default']);
            echo Html::endForm();
            echo '</div>';

            echo '<div class="col-md-3">';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 1);
            echo Html::submitButton('<i class="fa fa-fw fa-play"></i>Process', ['class' => 'btn btn-info']);
            echo Html::endForm();
            echo '</div>';

            echo '<div class="col-md-3">';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 2);
            echo Html::submitButton('<i class="fa fa-fw fa-check-circle"></i>Approve', ['class' => 'btn btn-success']);
            echo Html::endForm();
            echo '</div>';

            echo '<div class="col-md-3">';
            echo Html::beginForm(Url::to(['approve']), 'post', ['class' => 'form', 'role' => 'form']);
            echo Html::hiddenInput('actId', $modelActivityRoom->id, ['class' => 'actId']);
            echo Html::hiddenInput('command', 3);
            echo Html::submitButton('<i class="fa fa-fw fa-times-circle"></i>Reject', ['class' => 'btn btn-danger']);
            echo Html::endForm();
            echo '</div>';
        ?>
    </div>


</div>
