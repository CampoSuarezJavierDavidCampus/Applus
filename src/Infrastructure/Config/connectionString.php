<?php
namespace Infrastructure\Config;
return Array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'shop',
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
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        // Set character set
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ]
    );