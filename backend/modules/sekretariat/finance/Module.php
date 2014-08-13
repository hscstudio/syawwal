<?php

namespace backend\modules\sekretariat\finance;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\finance\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon' => 'fa fa-fw fa-money','label' => 'Sbu', 'url' => ['/'.$this->uniqueId.'/sbu/index']],
		];
	}
}
