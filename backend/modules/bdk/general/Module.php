<?php

namespace backend\modules\bdk\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\bdk\general\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-stack-overflow','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'], 'path' => 'training'],
			['icon'=>'fa fa-fw fa-users', 'label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index'], 'path' => 'employee'],
			['icon'=>'fa fa-fw fa-gavel', 'label' => 'Satker PIC', 'url' => ['/'.$this->uniqueId.'/satker-pic/index'], 'path' => 'satker-pic'],
		];
	}
}
