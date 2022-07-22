<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\models\Login;
use app\models\Product;
use app\models\User;

class AdminController extends Controller
{
    public function index()
    {
        $this->registerMiddleware(new AuthMiddleware(['admin']));
        $product = new Product();
        $prods = $product->getProducts();
            return  $this->render('admin', [
                'prods' => $prods
            ]);
    }
}
