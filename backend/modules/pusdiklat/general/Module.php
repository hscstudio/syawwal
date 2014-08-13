<?php

namespace backend\modules\pusdiklat\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\general\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training'],
			['label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index'],'path'=>'employee'],
			['label' => 'PIC Satker', 'url' => ['/'.$this->uniqueId.'/satker-pic/index'],'path'=>'satker-pic'],
			//['label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
