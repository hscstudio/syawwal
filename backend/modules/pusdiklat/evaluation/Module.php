<?php

namespace backend\modules\pusdiklat\evaluation;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\evaluation\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-check-square-o','label' => 'Evaluasi Diklat', 'url' => ['#'],'items'=>[
				['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index']],
			]],
			['icon'=>'fa fa-fw fa-cloud','label' => 'PHD', 'url' => ['#'],'items'=>[
				['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training2', 'url' => ['/'.$this->uniqueId.'/training2/index']],
			]],
			['icon'=>'fa fa-fw fa-book','label' => 'IPK', 'url' => ['#'],'items'=>[
				['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training3', 'url' => ['/'.$this->uniqueId.'/training3/index']],
			]],
		];
	}
}
