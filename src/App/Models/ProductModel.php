<?php
namespace App\Model;

use App\DTO\ProductDTO;
use Core\Entities\Category;
use Core\Entities\Product;
use DateTime;
use Infrastructure\Config\Connection;

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
    public function show():array{ 
        $conn = Connection::get_conn();            
        //GET DATA
        $stmt = $conn->prepare($this->ShowSQL);
        $stmt->execute();
        $datos = $this->transformData($stmt->fetchAll());
        //CLEAN
        $stmt = null;
        $conn = null;
        //RETURN
        return $datos;        
    }

    //*CREATE PRODUCT
    public function create(ProductDTO $product):bool{
        $conn = Connection::get_conn();            
        //ADD DATA
        $stmt = $conn->prepare($this->CreateSQL);
        $stmt->bindParam(':code',$product->code);
        $stmt->bindParam(':name',$product->name);
        $stmt->bindParam(':categoryId',$product->categoryId);
        $stmt->bindParam(':price',$product->price);
        $stmt->bindParam(':createAt',new DateTime());
        $stmt->bindParam(':updateAt',new DateTime());
        $stmt->execute();        
        //CLEAN
        $stmt = null;
        $conn = null;
        //RETURN
        return true;    
    }

    //*EDIT PRODUCT
    public function edit(ProductDTO $product):bool{
        $conn = Connection::get_conn();            
        //ADD DATA
        $stmt = $conn->prepare($this->EditSQL);
        $stmt->bindParam(':code',$product->code);
        $stmt->bindParam(':name',$product->name);
        $stmt->bindParam(':categoryId',$product->categoryId);
        $stmt->bindParam(':price',$product->price);
        $stmt->bindParam(':updateAt',new DateTime());
        $stmt->execute();        
        //CLEAN
        $stmt = null;
        $conn = null;
        //RETURN
        return true;    
    }

    //*DELETE PRODUCT
    public function delete(string $code):bool{
        $conn = Connection::get_conn();            
        //ADD DATA
        $stmt = $conn->prepare($this->DeleteSQL);
        $stmt->bindParam(':code',$code);       
        $stmt->execute();        
        //CLEAN
        $stmt = null;
        $conn = null;
        //RETURN
        return true;    
    }

    private function transformData(array $products):array{
        $datos = [];
        foreach($products as $product){
            $datos[]=new Product(
                $product['product_code'],
                $product['product_name'],
                new Category(
                    $product['category_name'],
                    $product['category_id'],
                    $product['category_createAt'],
                    $product['category_updateAt'],
                ),
                $product['product_price'],
                $product['product_createAt'],
                $product['category_updateAt'],
            );
        }
        return $datos;
    }
}