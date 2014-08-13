<?php

namespace backend\modules\sekretariat\organisation;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\organisation\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-graduation-cap','label' => 'Graduate', 'url' => ['/'.$this->uniqueId.'/graduate/index']],
			['icon'=>'fa fa-fw fa-empire', 'label' => 'Religion', 'url' => ['/'.$this->uniqueId.'/religion/index']],
			['icon'=>'fa fa-fw fa-trophy', 'label' => 'RankClass', 'url' => ['/'.$this->uniqueId.'/rank-class/index']],
			['icon'=>'fa fa-fw fa-institution', 'label' => 'Satker', 'url' => ['/'.$this->uniqueId.'/satker/index']],
			['icon'=>'fa fa-fw fa-database', 'label' => 'StaUnit', 'url' => ['/'.$this->uniqueId.'/sta-unit/index']],
			['icon'=>'fa fa-fw fa-building', 'label' => 'Unit', 'url' => ['/'.$this->uniqueId.'/unit/index']],			
		];
	}
}
