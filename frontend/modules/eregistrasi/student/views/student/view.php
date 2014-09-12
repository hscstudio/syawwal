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
$data = \frontend\models\Student::find()->where(['nip'=>Yii::$app->user->identity->nip])->One();
$tgllahir = explode('-',$data->birthDay);
?>
<?php
    Modal::begin([
		'header'=>'PRINT FORM EREGISTERASI',
		//'data' => $model,
		'toggleButton' => ['label'=>'PRINT', 'class'=>'fa fa-fw fa-search'],
	]);
?>
<table align="center" cellspacing="1" cellpadding="2" style="font-family:'Times New Roman', Times, serif" width="100%">
	<tr>
    	<td width="8%" rowspan="4"><img src="<?php echo Yii::getAlias('@web');?>/DepkeuLogo.jpg" width="55" height="60" />
   	  <td width="1%"></td><td width="91%">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</td>
    </tr>
    <tr>
    	<td></td><td>BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN</td>
    </tr>
    <tr>
    	<td></td><td></td>
    </tr>
    <tr>
    	<td></td><td></td>
    </tr>
</table>
<hr />
<table align="center" style="font-family:'Times New Roman', Times, serif" width="100%">
	<tr>
    	<td width="33%">NAMA</td><td width="2%">:</td><td width="65%"><?php echo strtoupper($data->name);?></td>
    </tr>
    <tr>
    	<td>NIP</td><td>:</td><td><?php echo $data->nip;?></td>
    </tr>
    <tr>
    	<td>TEMPAT / TANGGAL LAHIR </td><td>:</td><td><?php echo strtoupper($data->born);?> / <?php echo $tgllahir[2].'-'.$tgllahir[1].'-'.$tgllahir[0];?></td>
    </tr>
    <tr>
    	<td>KEMENTERIAN</td><td>:</td><td>KEMENTERIAN KEUANGAN</td>
    </tr>
    <tr>
    	<td>UNIT ORGANISASI</td><td>:</td><td><?php echo strtoupper(\frontend\models\Unit::findOne($data->ref_unit_id)->name);?></td>
    </tr>
    <tr>
    	<td>PANGKAT / GOLONGAN</td><td>:</td><td><?php echo strtoupper(\frontend\models\RankClass::findOne($data->ref_rank_class_id)->name);?></td>
    </tr>
    <tr>
    	<td>JABATAN</td><td>:</td><td><?php echo strtoupper($data->position);?></td>
    </tr>
    <tr>
    	<td>STATUS PESERTA</td><td>:</td><td>BARU</td>
    </tr>
    
</table>
<table style="font-family:'Times New Roman', Times, serif" width="100%">
	<tr>
    	<td >&nbsp;</td><td ></td><td></td>
    </tr>
    <tr>
    	<td colspan="3" style="font-size:12px">Dengan ini saya menyatakan bahwa data yang saya inputkan adalah benar dan dapat dipertanggungjawabkan.</td>
    </tr>
    <tr>
    	<td >&nbsp;</td><td ></td><td></td>
    </tr>
    <tr>
    	<td>&nbsp;</td><td></td><td>..........,<?php echo date('M Y');?></td>
    </tr>
    <tr>
    	<td>PETUGAS REGISTERASI</td><td>&nbsp;</td><td>HORMAT SAYA</td>
    </tr>
    <tr>
    	<td>&nbsp;</td><td></td><td></td>
    </tr>
    <tr>
    	<td >&nbsp;</td><td ></td><td></td>
    </tr>
    <tr>
    	<td>.......................................</td><td></td><td>.......................</td>
    </tr>
</table>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo \yii\helpers\Url::to('print');?>'">Print</button>
               
</div>
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