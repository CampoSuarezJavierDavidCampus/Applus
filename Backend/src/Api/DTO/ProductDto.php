<?php
namespace Api\DTO;

use DateTime;

class ProductDTO{
    public function __construct(
        public string $code,
        public string $name,
        public int $categoryId,
        public float $price,
    ) {}
}