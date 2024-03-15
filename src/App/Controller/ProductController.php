<?php
namespace App\Controller;

use App\Model\ProductModel;
use Core\Entities\Product;

class ProductController{
    private ProductModel $model;
    public function __construct() {
        $this->model = new ProductModel();
    }

    public function show(){
        //Obtener la data
        $data = $this->model->show();
        var_dump($data);
        return $data;
    }
    public function create():string{
        return "OK";
    }
    public function edit():string{
        return "OK";
    }
    public function delete():string{
        return "OK";
    }
}