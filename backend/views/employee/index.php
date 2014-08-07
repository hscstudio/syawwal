<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            'ref_satker_id',
            'ref_unit_id',
            'ref_religion_id',
            'ref_rank_class_id',
            // 'ref_graduate_id',
            // 'ref_sta_unit_id',
            // 'name',
            // 'nickName',
            // 'frontTitle',
            // 'backTitle',
            // 'nip',
            // 'born',
            // 'birthDay',
            // 'gender',
            // 'phone',
            // 'email:email',
            // 'address',
            // 'married',
            // 'photo',
            // 'blood',
            // 'position',
            // 'education',
            // 'officePhone',
            // 'officeFax',
            // 'officeEmail:email',
            // 'officeAddress',
            // 'document1',
            // 'document2',
            // 'status',
            // 'created',
            // 'createdBy',
            // 'modified',
            // 'modifiedBy',
            // 'deleted',
            // 'deletedBy',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
