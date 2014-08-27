<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingUnitPlan */

$this->title = $model->training->name;
$this->params['breadcrumbs'][] = ['label' => 'Training Unit Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-unit-plan-view">

    <?php
        $arrSpread = explode('|', $model->spread);
        $unit = ['Setjen', 'Itjen', 'DJA', 'DJP', 'DJBC', 'DJPBn', 'DJKN', 'DJPK', 'DJPU', 'BKF', 'Bapepam', 'BPPK', 'Lainnya'];
        $injectData = [];
        if (count($arrSpread) == 13)
        {
            foreach ($arrSpread as $key => $value) {
                $injectData[] = 
                    [
                        'attribute' => 'spread',
                        'label' => $unit[$key],
                        'value' => $value
                    ]
                ;
            }
        }

        echo DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Training Unit Plans # ' . $model->training->name,
			'type'=>DetailView::TYPE_DEFAULT,
		],
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i>Back to Index',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' '.
					 Html::a('<i class="fa fa-fw fa-trash-o"></i>Delete',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),
        'attributes' => $injectData,
    ]) ?>

</div>
