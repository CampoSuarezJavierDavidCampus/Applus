<?php
namespace Api\Controller;

use Infrastructure\Scripts\ValidateInputs;
use Api\DTO\ProductDTO;
use Api\Model\ProductModel;

class ProductController{
    use ValidateInputs;

    private ProductModel $model;
    public function __construct() {
        $this->model = new ProductModel();
    }

    public function show(){
        //Obtener la data
        $data = $this->model->show();
        return $data;
    }
    public function create():int|null{
        $product = json_decode(file_get_contents('php://input'),true);
        $res = $this->model->create(new ProductDTO(
            $this->sanitizarTextInput($product['code']),
            $this->sanitizarTextInput($product['name']),
            $this->sanitizarNumberInput($product['categoryId']),
            $this->sanitizarFloatNumberInput($product['price'])
        ));
        if(is_null($res))http_response_code(400);
        else http_response_code(201);
        return $res;
    }
    public function edit():int|null{
        $product = json_decode(file_get_contents('php://input'),true);
        $res = $this->model->edit(new ProductDTO(
            $this->sanitizarTextInput($product['code']),
            $this->sanitizarTextInput($product['name']),
            $this->sanitizarNumberInput($product['categoryId']),
            $this->sanitizarFloatNumberInput($product['price'])
        ));
        if(is_null($res))http_response_code(404);
        else http_response_code(205);
        return $res;
    }
    public function delete(){

        $code = $this->sanitizarTextInput($_GET['code']);
        $res = $this->model->delete($code);
          /* if(is_null($res))http_response_code(404);
          else http_response_code(204);
          return $res; */

    }
}