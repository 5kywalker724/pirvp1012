<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username'], 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой логин уже занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такая почта уже занята'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signup()
    {
        if(!$this->validate()){
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
        ];
    }
}
