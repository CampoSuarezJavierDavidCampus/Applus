<?php
namespace Infrastructure\Config;
use Infrastructure\Config\ConnectionString as connection;
class Database{
    private \PDO|null $conn = null;
    public function __construct(array $setting) {        
        $this->set_connection_string($setting);
    }

    public function get_connection():\PDO|null{
        return $this->conn; 
    }
    private function set_connection_string(array $setting){ 
        $this->conn = null;
        try{
            $dsn = "{$setting['driver']}:host={$setting['host']};dbname={$setting['database']}";
            $this->conn = new \PDO($dsn, $setting['username'], $setting['password'], $setting['flags']);                
        }catch(\PDOException $exception){
            $error=[[
                'error' => $exception->getMessage(),
                'message' => 'Error al momento de establecer conexion'
            ]];
            echo var_dump($error);            
        }        
    }
}