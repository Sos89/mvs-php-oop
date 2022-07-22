<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Product;
use app\models\Login;
use app\models\Reviews;
use app\models\User;

class ReviewsController extends Controller
{
    public function insert(Request $request, Response $response){
        $review = new Reviews();
        $review->loadData($request->getBody());
        if ($request->isPost()){
            $review->loadData($request->getBody());
            if ($review->create()){
                Application::$app->session->setFlash('success', 'Commented success');
                $response->redirect('/dashboard');
            }
        }
        return $this->render('/dashboard', [
            'model' => $review
        ]);
    }
    public function review()
    {
        $id = $_GET['id'];
        $product = new Product();
        $review = new Reviews();
        $prods =  $product->findProduct($id);
        $avg = $review->avg($id);
        $int_cast = (int)$avg;
        $product->reviewUpdate($id,$int_cast);
        return  $this->render('review', [
            'prods' => $prods
        ]);
    }
    public function view()
    {
        $id = $_GET['id'];
        $product = new Product();
        $prod = $product->findProduct($id);
        $review = new Reviews();
        $s = $review->inner($id);
        return  $this->render('view', [
            'review' => $s,
            'product'=>$prod
        ]);
    }
}