<?php

namespace frontend\modules\eregistrasi;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\eregistrasi\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['icon'=>'fa fa-fw fa-child', 'label' => 'Biodata', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
