<?php

namespace backend\modules\sekretariat\organisation;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\organisation\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['label' => 'Graduate', 'url' => ['/'.$this->uniqueId.'/graduate/index']],
			['label' => 'Religion', 'url' => ['/'.$this->uniqueId.'/religion/index']],
			['label' => 'RankClass', 'url' => ['/'.$this->uniqueId.'/rank-class/index']],
			['label' => 'Satker', 'url' => ['/'.$this->uniqueId.'/satker/index']],
			['label' => 'StaUnit', 'url' => ['/'.$this->uniqueId.'/sta-unit/index']],
			['label' => 'Unit', 'url' => ['/'.$this->uniqueId.'/unit/index']],			
		];
	}
}
