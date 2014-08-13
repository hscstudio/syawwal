<?php

namespace backend\modules\pusdiklat\planning;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\planning\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-code-fork', 'label' => 'Program', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-list','label' => 'Program', 'url' => ['/'.$this->uniqueId.'/program/index'],'path'=>'program'],
				['icon'=>'fa fa-fw fa-stack-overflow','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training'],
			]],
			['icon'=>'fa fa-fw fa-university', 'label' => 'Kurikulum', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training2/index']],
			]],
			['icon'=>'fa fa-fw fa-users', 'label' => 'Tenaga Pengajar', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training3/index']],
			]],
		];
	}
}
