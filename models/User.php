<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    const DOCTOR = 2;
    const PATIENT = 1;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user  = User::find()
            ->where(['id' => $id])->one();
        return isset($user->id) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()
            ->where(['access_token' => $token])->one();
        if ($user)
            return new static($user);

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username, $password)
    {
        $user = User::find()
            ->where(['username' => $username, 'password' => md5($password)])->one();
        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public static function saveUser($data) {
        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = md5($data['password']);
        $user->type_id = $data['type_id'];
        if ($user->insert())
            return true;
        else
            return false;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
