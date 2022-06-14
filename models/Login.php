<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class Login extends Model
{
    public string $email = '';
    public string $password = '';
    public string $status = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Your Email',
            'password' => 'Password',
        ];
    }

    public function login()
    {
        $user = (new User)->findOne(['email' => $this->email]);

        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        return [
            'user' => Application::$app->login($user),
            'status' => $user->status
        ];
    }
}