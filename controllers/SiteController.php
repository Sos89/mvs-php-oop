<?php
namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\Login;
use app\models\Product;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['dashboard']));
    }
    public function home()
    {
        return $this->render('home');
    }

    public function dashboard()
    {
        $products = new Product();
        $prods = $products->getProducts();
        return  $this->render('dashboard', [
            'prods' => $prods
        ]);
    }
    public function comment()
    {
        $prods = new Product();
        return $this->render('comment', [
            'prods' => $prods
        ]);
    }
}