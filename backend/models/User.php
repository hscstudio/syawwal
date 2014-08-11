<?php

namespace backend\models;

use Yii;
use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_user';
    }

}
