<?php

namespace app\models;

use app\core\DbModel;
use app\core\UserModel;

class User extends UserModel
{
    public string $name = '';
    public string $surname = '';
    public string $age = '';
    public string $email = '';
    public int $status = 0;
    public string $password = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'surname' => [self::RULE_REQUIRED],
            'age' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 8]],
        ];
    }

    public function attributes(): array
    {
        return [
            'name',
            'surname',
            'age',
            'email',
            'password',
            'status'
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name',
            'surname' => 'Surname',
            'age' => 'Age',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }


    public function getDisplayName(): string
    {
        return $this->name;
    }
}