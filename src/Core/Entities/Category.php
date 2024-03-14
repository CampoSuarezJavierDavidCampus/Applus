<?php
namespace Core\Entities;

use DateTime;

class Category{    
    public function __construct(
        public int $id,
        public string $name,
        public DateTime $createAt,
        public DateTime $updateAt
    ) {}    
}