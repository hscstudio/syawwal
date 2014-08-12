<?php

namespace backend\models;

use Yii;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    public static function tableName()
    {
        return 'tb_user';
    }

    /*
    fajar - Menambah relasi, 1-1 ke Employee
    */
    public function getEmployee()
    {
    	return $this->hasOne(Employee::classname(), ['user_id' => 'id'])->inverseOf('employee');
    }

}
