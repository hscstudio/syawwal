<?php

namespace backend\modules\sekretariat\hrd;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\hrd\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['icon'=>'user','label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
