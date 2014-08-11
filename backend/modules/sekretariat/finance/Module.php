<?php

namespace backend\modules\sekretariat\finance;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\finance\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['label' => 'Sbu', 'url' => ['/'.$this->uniqueId.'/sbu/index']],
		];
	}
}
