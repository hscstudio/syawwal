<?php

namespace frontend\modules\training;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\training\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['icon'=>'fa fa-fw fa-book', 'label' => 'Properti Diklat', 'url' => ['/'.$this->uniqueId.'/employee/index']],
			['icon'=>'fa fa-fw fa-child', 'label' => 'Peserta Diklat', 'url' => ['/'.$this->uniqueId.'/employee/index']],
			['icon'=>'fa fa-fw fa-male', 'label' => 'Evaluasi Pengajar', 'url' => ['/'.$this->uniqueId.'/employee/index']],
			['icon'=>'fa fa-fw fa-pencil-square-o', 'label' => 'Evaluasi Penyelenggaraan', 'url' => ['/'.$this->uniqueId.'/employee/index']],
			['icon'=>'fa fa-fw fa-download', 'label' => 'Download Dokumen Diklat', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
