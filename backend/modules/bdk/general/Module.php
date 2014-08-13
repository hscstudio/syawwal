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
			['icon'=>'fa fa-fw fa-book','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'], 'path' => 'training'],
			['icon'=>'fa fa-fw fa-users','label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index'], 'path' => 'training'],
			['icon'=>'fa fa-fw fa-university','label' => 'Satker PIC', 'url' => ['/'.$this->uniqueId.'/satker-pic/index'], 'path' => 'training'],
			['icon'=>'fa fa-fw fa-inbox','label' => 'Room', 'url' => ['/'.$this->uniqueId.'/room/index'], 'path' => 'training'],
		];
	}
}
