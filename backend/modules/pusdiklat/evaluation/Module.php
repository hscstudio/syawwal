<?php

namespace backend\modules\pusdiklat\evaluation;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\evaluation\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['icon'=>'dashboard','label' => 'Evaluasi Diklat', 'url' => ['#'],'items'=>[
				['label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index']],
			]],
			['icon'=>'dashboard','label' => 'PHD', 'url' => ['#'],'items'=>[
				['label' => 'Training2', 'url' => ['/'.$this->uniqueId.'/training2/index']],
			]],
			['icon'=>'dashboard','label' => 'IPK', 'url' => ['#'],'items'=>[
				['label' => 'Training3', 'url' => ['/'.$this->uniqueId.'/training3/index']],
			]],
		];
	}
}
