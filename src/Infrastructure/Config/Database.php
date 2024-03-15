<?php
namespace Infrastructure\Config;
class Database{
    static private Database|null $db = null;
    private \PDO|null $conn = null;
    private function __construct() {        
        $this->set_connection_string(require_once('ConnectionString.php'));
    }    
    static public function Access(callable $executeRequest, ...$args){
        if(is_null(self::$db))self::$db = new Database();
        self::$db;
        
        try {
            return call_user_func_array($executeRequest,['conn'=>self::$db->conn,'params'=>$args]);
        } catch (\Throwable $th) {
            
            echo var_dump($th->getMessage());    
            return null;                        
        }
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