<?php

namespace app\models;


use app\core\db\DbModel;
use app\core\Request;

class Product extends DbModel
{

    public string $name = '';
    public string $description = '';
    public string $image = '';

    public function tableName(): string
    {
        return 'products';
    }

    public function attributes(): array
    {
        return [
            $this->name ,
            $this->description ,
            $this->image
        ];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return
        [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'name' => "Enter your name",
            'description' => "Description",
            'image' => "Image"
        ];
    }
    private static function randomString($n)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $n; $i++){
            $index = rand(0, strlen($characters) - 1);
            $str .=$characters[$index];
        }
        return $str;
    }
    public function create()
    {
        if (!is_dir('images')) {
            mkdir('images');
        }
        $image = $_FILES['image'] ?? null;
        $imagePath = '';
        if ($image){
            $imagePath = 'images/'. self::randomString(8).$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $this->attributes());
        if (!empty($params)) {
            $statement = self::prepare("INSERT INTO $tableName 
                    (`id`,`name`, `description`, `image`)
                   VALUES ( null, '$this->name', '$this->description', '$imagePath')");
        }
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function getProducts()
    {
        $state = self::prepare('SELECT * FROM products');
        $state->execute();
        return $state->fetchAll();
    }
    public function findProduct($id)
    {
        $state = self::prepare("SELECT *  FROM `products` WHERE id = '$id' ");
        $state->execute();
        return $state->fetchAll();
    }

    public function update($id)
    {
        if (!is_dir('images')) {
            mkdir('images');
        }

        $image = $_FILES['image'];
        $image_current = $_POST['image_current'];
        if ($image['name'] != ''){
            unlink($image['name']);
            $imagePath = 'images/'. self::randomString(8).$image['name'];
            move_uploaded_file($image['tmp_name'], $imagePath);
        }else{
            $imagePath = $image_current;
        }
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $this->attributes());
        if (!empty($params)) {
            $statement = self::prepare("UPDATE `$tableName` SET
                    `name` = '$this->name', `description` = '$this->description', `image` = '$imagePath'  WHERE `id` = '$id'");
        }
        foreach ($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public function reviewUpdate($id,$avg){
        $statement = self::prepare("UPDATE `products` SET
                    `rev` = '$avg' WHERE `id` = '$id'");
        $statement->execute();
        return true;
    }

    public function delete($id){
        $statemente = self::prepare("DELETE FROM `products` WHERE `id` = '$id'");
        $statemente->execute();
    }

}