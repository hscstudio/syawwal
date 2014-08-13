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
    mengoverride rules
    */
    public function rules()
    {
        return [
            // username rules
            ['username', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9]\w+$/'], // sebenarnya cuma mau bikin supaya username bisa pake angka
            ['username', 'string', 'min' => 3, 'max' => 25],
            ['username', 'unique'],
            ['username', 'trim'],

            // email rules
            ['email', 'required', 'on' => ['register', 'connect', 'create', 'update', 'update_email']],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],
            ['email', 'trim'],

            // unconfirmed email rules
            ['unconfirmed_email', 'required', 'on' => 'update_email'],
            ['unconfirmed_email', 'unique', 'targetAttribute' => 'email', 'on' => 'update_email'],
            ['unconfirmed_email', 'email', 'on' => 'update_email'],

            // password rules
            ['password', 'required', 'on' => ['register', 'update_password']],
            ['password', 'string', 'min' => 6, 'on' => ['register', 'update_password', 'create']],

            // current password rules
            ['current_password', 'required', 'on' => ['update_email', 'update_password']],
            ['current_password', function ($attr) {
                if (!empty($this->$attr) && !Password::validate($this->$attr, $this->password_hash)) {
                    $this->addError($attr, \Yii::t('user', 'Current password is not valid'));
                }
            }, 'on' => ['update_email', 'update_password']],
        ];
    }

    /*
    Menambah relasi, 1-1 ke Employee
    */
    public function getEmployee()
    {
    	return $this->hasOne(Employee::classname(), ['user_id' => 'id']);
    }

}
