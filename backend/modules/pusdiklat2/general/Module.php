<?php

namespace backend\modules\pusdiklat2\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat2\general\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training'],
			['icon'=>'fa fa-fw fa-users', 'label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index'],'path'=>'employee'],
			['icon'=>'fa fa-fw fa-university', 'label' => 'PIC Satker', 'url' => ['/'.$this->uniqueId.'/satker-pic/index'],'path'=>'satker-pic'],
		];
	}
}
