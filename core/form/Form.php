<?php

namespace app\core\form;

use app\core\Model;
use app\models\Product;

class Form
{
    public static function begin($action, $method, $enctype)
    {
        echo sprintf('<form action="%s" method="%s" enctype="%s">', $action, $method, $enctype);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new inputField($model, $attribute);
    }

    public function data(Product $data, $attribute)
    {
        return new inputField($data, $attribute);
    }


}