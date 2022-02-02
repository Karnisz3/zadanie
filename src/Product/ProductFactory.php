<?php
declare(strict_types = 1);

namespace Source\Product;

class ProductFactory
{
    public static function build(array $data): Product
    {
        return new Product(
            (int)$data['id'],
            $data['title'],
            (float)$data['price'],
            $data['currency']
        );
    }
}