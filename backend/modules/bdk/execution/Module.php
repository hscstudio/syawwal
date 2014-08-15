<?php

namespace backend\modules\bdk\execution;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\bdk\execution\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			//['icon'=>'fa fa-fw fa-dashboard', 'label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
