<?php

namespace app\models;

use app\core\Application;
use app\core\db\DbModel;

class Reviews extends DbModel
{


    public string $user_name = '';
    public string $product_id = '';
    public string $stars = '';
    public string $comment_text = '';

    public function tableName(): string
    {
        return 'reviews';
    }

    public function attributes(): array
    {
        return [
            $this->user_name,
            $this->stars,
            $this->product_id,
            $this->comment_text,
        ];

    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'comment_text' => [self::RULE_REQUIRED],
            'stars' => [self::RULE_REQUIRED],
        ];

    }

    public function inner($id){
        $sql = self::prepare("SELECT * FROM reviews WHERE product_id='$id' ");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function avg($id){
        $sql = self::prepare("SELECT AVG(stars) FROM reviews WHERE product_id = '$id' ");
        $sql->execute();
        return $sql->fetchColumn();
    }

    public function create()
    {
        $user =  Application::$app->session->get('user');
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $this->attributes());
        if (!empty($params)) {
            $statement = self::prepare("INSERT INTO $tableName 
                    (`user_name`, `comment_text`, `product_id`, `stars`)
                   VALUES ('$user', '$this->comment_text', '$this->product_id', '$this->stars')");
        }
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }
}