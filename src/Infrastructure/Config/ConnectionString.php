<?php
namespace Infrastructure\Config;
class Connection{
    private Database|null $_DB;
    
    public function get_conn():\PDO{
        if(is_null($this->_DB) ){
            $this->_DB = new Database($this->_connectionString);
        }
        return $this->_DB->get_connection();
    }
    
    private $_connectionString = Array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'username' => 'root',
        'database' => 'mitienda',
        'password' => '123456',
        'collation' => 'utf8mb4_unicode_ci',
        'flags' => [
            // Turn off persistent connections
            \PDO::ATTR_PERSISTENT => false,
            // Enable exceptions
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            // Emulate prepared statements
            \PDO::ATTR_EMULATE_PREPARES => true,
            // Set default fetch mode to arrayfetch_object
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            // Set character set
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
        ]
        );
    
}
