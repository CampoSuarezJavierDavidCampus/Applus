<?php
namespace Core\Entities;

use DateTime;

class Product{
    public function __construct(
        public string $code,
        public string $name,
        public Category $category,
        public float $price,
        public DateTime $createAt,
        public DateTime $updateAt
    ) {}
}