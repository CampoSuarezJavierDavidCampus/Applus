<?php
namespace Api\Model;

use Infrastructure\Config\Database;
use Api\DTO\ProductDTO;
use Core\Entities\Category;
use Core\Entities\Product;
use DateTime;

class ProductModel{

    private string $ShowSQL = "SELECT
        /*product*/
        p.code as product_code,
        p.name as product_name ,
        p.price as product_price ,
        p.createAt as product_createAt,
        p.updateAt as product_updateAt,
        /*categoria*/
        c.id as category_id,
        c.name as category_name,
        c.createAt as category_createAt,
        c.updateAt as category_updateAt
    from product p join category c on c.id = p.categoryId;";

    private string $CreateSQL = "INSERT INTO
    product (code, name, categoryId, price, createAt, updateAt)
    VALUES(:code, :name, :categoryId, :price, :createAt, :updateAt)";

    private string $EditSQL = "UPDATE product SET
        name = :name,
        categoryId = :categoryId,
        price      = :price,
        updateAt   = :updateAt
        WHERE code = :code";

    private string $DeleteSQL = "DELETE FROM product WHERE code = :code";



    //*SHOW PRODUCT LIST
    public function show():array|null{
        $res = Database::Access(function(...$args){
            //GET DATA
            $stmt = $args['conn']->prepare($this->ShowSQL);
            $stmt->execute();
            $datos = $this->transformData($stmt->fetchAll());

            //CLEAN
            $stmt = null;
            $args['conn'] = null;

            return $datos;
        });

        //RETURN
        return $res;
    }

    //*CREATE PRODUCT
    public function create(ProductDTO $product):int|null{
        $res = Database::Access(function(...$args){
            $product = $args['params'][0];
           //ADD DATA
            $stmt = $args['conn']->prepare($this->CreateSQL);
            $stmt->bindParam(':code',$product->code,\PDO::PARAM_STR);
            $stmt->bindParam(':name',$product->name,\PDO::PARAM_STR);
            $stmt->bindParam(':categoryId',$product->categoryId,\PDO::PARAM_INT);
            $stmt->bindParam(':price',$product->price,\PDO::PARAM_INT);
            $stmt->bindParam(':createAt',(new DateTime())->format('Y-m-d H:i:s'),\PDO::PARAM_STR);
            $stmt->bindParam(':updateAt',(new DateTime())->format('Y-m-d H:i:s'),\PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->rowCount();
            //CLEAN
            $stmt = null;
            $args['conn'] = null;
            //RETURN
            return $res;
        },$product);
        return $res;

    }

    //*EDIT PRODUCT
    public function edit(ProductDTO $product):int|null{
        $res = Database::Access(function(...$args){
            $product = $args['params'][0];
            //ADD DATA
            $stmt = $args['conn']->prepare($this->EditSQL);
            $stmt->bindParam(':code',$product->code,\PDO::PARAM_STR);
            $stmt->bindParam(':name',$product->name,\PDO::PARAM_STR);
            $stmt->bindParam(':categoryId',$product->categoryId,\PDO::PARAM_INT);
            $stmt->bindParam(':price',$product->price,\PDO::PARAM_INT);
            $stmt->bindParam(':updateAt',(new DateTime())->format('Y-m-d H:i:s'),\PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->rowCount();
            //CLEAN
            $stmt = null;
            $args['conn'] = null;
            //RETURN
            return $res;
         },$product);
         return $res;
    }

    //*DELETE PRODUCT
    public function delete(string $code):int|null{
        $res = Database::Access(function(...$args){
            $code = $args['params'][0];
            //ADD DATA
            $stmt = $args['conn']->prepare($this->DeleteSQL);
            $stmt->bindParam(':code',$code,\PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->rowCount();
            //CLEAN
            $stmt = null;
            $args['conn'] = null;
            //RETURN

            return $res;
        },$code);
        return $res;
    }

    private function transformData(array $products):array{

        $datos = [];
        foreach($products as $product){
            $datos[]=new Product(
                $product['product_code'],
                $product['product_name'],
                new Category(
                    $product['category_id'],
                    $product['category_name'],
                    new DateTime($product['category_createAt']),
                    new DateTime($product['category_updateAt'])
                ),
                $product['product_price'],
                new DateTime($product['product_createAt']),
                new DateTime($product['product_updateAt'])
            );
        }
        return $datos;
    }
}