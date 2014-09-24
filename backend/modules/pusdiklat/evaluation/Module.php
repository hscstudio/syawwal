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
				['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>[
					'/training/',
				]],
				['icon'=>'fa fa-fw fa-users', 'label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student/index'],'path'=>[
					'/student/',
				]],
				['icon'=>'fa fa-fw fa-link', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting/index'],'path'=>[
					'/meeting/',
				]]
			]],
			['icon'=>'fa fa-fw fa-cloud','label' => 'PHD', 'url' => ['#'],'items'=>[
				['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training2/index'],'path'=>[
					'training2/','training-class2/','training-class-student2/'
				]],
				['icon'=>'fa fa-fw fa-users', 'label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student2/index'],'path'=>[
					'/student2/',
				]],
				['icon'=>'fa fa-fw fa-link', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting2/index'],'path'=>[
					'/meeting2/',
				]]				
			]],
			['icon'=>'fa fa-fw fa-book','label' => 'IPK', 'url' => ['#'],'items'=>[
				['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training3/index'],'path'=>[
					'/training3/',
				]],
				['icon'=>'fa fa-fw fa-link', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting3/index'],'path'=>[
					'/meeting3/',
				]]
			]],
		];
	}
}
