<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\User;

/**
 * LoginForm is the model behind the login form.
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;
    public $email;
    public $type_id;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email', 'confirm_password'], 'required'],
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            ['email', 'checkEmail']
        ];
    }

    public function checkEmail($attribute) {
        if (!$this->hasErrors()) {
            $user = User::find()
                ->where(['email' => $attribute])
                ->one();
            if (!$user) {
                $this->addError($attribute, 'Incorrect email.');
            }
        }
    }
}
