<?php
namespace frontend\modules\eregistrasi\trainingclass;
use yii\web\Session;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\eregistrasi\trainingclass\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		
		$session = new Session;
		   //$session->open();
		   $tb_training_id = $session['tb_training_id']; 
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default/index?tb_training_id='.$tb_training_id],'path'=>'default/'],
			// Add here your items module
			['icon'=>'fa fa-fw fa-cutlery', 'label' => 'Properti Diklat', 'url' => ['/'.$this->uniqueId.'/properti-diklat/index'],'path'=>'properti-diklat/'],
			['icon'=>'fa fa-fw fa-user', 'label' => 'Peserta Diklat', 'url' => ['/'.$this->uniqueId.'/training-class-student/index'],'path'=>'training-class-student/'],
			['icon'=>'fa fa-fw fa-sliders', 'label' => 'Evaluasi Pengajar', 'url' => ['/'.$this->uniqueId.'/properti-diklat/index'],'path'=>'properti-diklat/'],
			['icon'=>'fa fa-fw fa-sliders', 'label' => 'Evaluasi Penyelenggara', 'url' => ['/'.$this->uniqueId.'/properti-diklat/index'],'path'=>'properti-diklat/'],
			['icon'=>'fa fa-fw fa-download', 'label' => 'Download Document', 'url' => ['/'.$this->uniqueId.'/properti-diklat/index'],'path'=>'properti-diklat/'],
		];
	}
}
