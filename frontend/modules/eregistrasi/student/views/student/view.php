<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap\Modal;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<?php
    Modal::begin([
		'header'=>'PRINT FORM EREGISTERASI',
		'toggleButton' => ['label'=>'PRINT', 'class'=>'fa fa-fw fa-search'],
		//'modalsize' => 'modal-lg',
	]);
?>
<table cellspacing="1" cellpadding="2" style="font-family:'Times New Roman', Times, serif">
	<tr>
    	<td rowspan="2"><img src="" /><td></td></td><td>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>
    </tr>
    <tr>
    	<td></td><td>BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN</td>
    </tr>
</table>
<table style="font-family:'Times New Roman', Times, serif">
	<tr>
    	<td>NAMA</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>NIP</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>TEMPAT / TANGGAL LAHIR </td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>KEMENTERIAN</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>UNIT ORGANISASI</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>PANGKAT / GOLONGAN</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>JABATAN</td><td>:</td><td></td>
    </tr>
    <tr>
    	<td>STATUS PESERTA</td><td>:</td><td></td>
    </tr>
</table>
<?php		
	Modal::end();
?>
<div class="student-view">
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>[
			'heading'=>'<i class="fa fa-fw fa-globe"></i> '.'Students',
			'type'=>DetailView::TYPE_DEFAULT,
		],
		
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['update?id='.Yii::$app->user->identity->id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						])
					
		,
        'attributes' => [
            //'id',
            'frontTitle',
			'name',
            'backTitle',
            'nip',
			'nickName',
            [
				'attribute' => 'ref_religion_id',
				'value' => $model->religion->name,
			],
            //'ref_religion_id',
            [
				'attribute' => 'ref_graduate_id',
				'value' => $model->graduate->name,
			],
           // 'ref_graduate_id',
            [
				'attribute' => 'ref_rank_class_id',
				'value' => $model->rankClass->name,
			],
            //'ref_rank_class_id',
            [
				'attribute' => 'ref_unit_id',
				'value' => $model->unit->name,
			],
            //'ref_unit_id',
            
            //'password_hash',
            //'auth_key',
            'born',
            'birthDay',
			[
				'attribute' => 'gender',
				'value' => $model->gender=0?'Female':'Male',
			],
            //'gender',
            'phone',
            'email:email',
            'address',
			[
				'attribute' => 'married',
				'value' => $model->married=0?'No':'Yes',
			],
            //'',
			[
				'attribute' => 'photo',
				'format' => 'html',
				'value' => '<img src='.\yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/'.$model->photo]).'>',
			],
            'blood',
            'position',
            'education',
            'eselon2',
            'eselon3',
            'eselon4',
            'satker',
            'officePhone',
            'officeFax',
            'officeEmail:email',
            'officeAddress',
            'noSKPangkat',
            'tmtSKPangkat',
            'fileSKPangkat',
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