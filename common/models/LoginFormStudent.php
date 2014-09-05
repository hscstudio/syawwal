<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginFormStudent extends Model
{
    public $nip;
    public $password;
    public $rememberMe = true;

    private $_student = false;
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nip', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
	 
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $student = $this->getStudent();
            if (!$student || !$student->validatePassword($this->password)) {
                 $this->addError($attribute, 'Incorrect nip or password.');
			 // print_r(!$student.' dan '.!Yii::$app->security->validatePassword($this->password, Yii::$app->security->generatePasswordHash($this->password)));
			  //exit();
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getStudent(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getStudent()
    {
        if ($this->_student === false) {
            $this->_student = Student::findByNip($this->nip);
        }

        return $this->_student;
    }
}
