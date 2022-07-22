<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Product;


class ProductController extends Controller
{
    public function insert(Request $request, Response $response)
    {
        $product = new Product();
        if ($request->isPost()){
            $product->loadData($request->getBody());
            if ($product->create()){
                Application::$app->session->setFlash('success', 'Created success');
                $response->redirect('/admin');
            }
        }
        return $this->render('admin', [
            'model' => $product
        ]);
    }
    public function edit(){
        $id = $_GET['id'];
        $product = new Product();
        $k =  $product->findProduct($id);
        return  $this->render('edit', [
            'model' => $k
        ]);
    }
    public function editProduct(Request $request, Response $response){
        $product = new Product();
        $arr = $request->getBody();
        if ($request->isPost()){
            $product->loadData($arr);
            if ($product->update($arr['id'])){
                Application::$app->session->setFlash('success', 'Updated success');
                $response->redirect('/admin');
            }
        }
        return $this->render('edit', [
            'model' => $product
        ]);
    }
    public function delete(){
        $id = $_GET['id'];
        $product = new Product();
        $product->delete($id);
        $products = $product->getProducts();
        return $this->render('/admin', [
            'prods' => $products
        ]);
    }
}
