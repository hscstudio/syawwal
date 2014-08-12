<?php

namespace backend\modules\pusdiklat\planning;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\planning\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['label' => 'Program', 'url' => ['#'], 'items'=>[
				['icon'=>'','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index']],
			]],
			['label' => 'Kurikulum', 'url' => ['#'], 'items'=>[
				['label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training2/index']],
			]],
			['label' => 'Tenaga Pengajar', 'url' => ['#'], 'items'=>[
				['label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training3/index']],
			]],
			//['label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index']],
		];
	}
}
