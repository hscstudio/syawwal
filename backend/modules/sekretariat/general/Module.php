<?php

namespace backend\modules\sekretariat\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\general\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['label' => 'Room', 'url' => ['/'.$this->uniqueId.'/room/index']],
		];
	}
}
