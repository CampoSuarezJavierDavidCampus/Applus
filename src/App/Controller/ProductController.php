<?php
namespace App\Controller;

use App\DTO\ProductDTO;
use App\Model\ProductModel;

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
    public function create():int|null{
        $product = json_decode(file_get_contents('php://input'),true);
        $res = $this->model->create(new ProductDTO(
            $product['code'],
            $product['name'],
            $product['categoryId'],
            $product['price']
        ));
        if(is_null($res))http_response_code(400);
        else http_response_code(201);
        return $res;
    }
    public function edit():int|null{
        $product = json_decode(file_get_contents('php://input'),true);
        $res = $this->model->edit(new ProductDTO(
            $product['code'],
            $product['name'],
            $product['categoryId'],
            $product['price']
        ));
        if(is_null($res))http_response_code(404);
        else http_response_code(205);
        return $res;
    }
    public function delete():int{
        $code = $_GET['code'];
        $res = $this->model->delete($code);
        if(is_null($res))http_response_code(404);
        else http_response_code(204);          
        return $res;
    }
}