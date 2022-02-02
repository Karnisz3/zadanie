<?php
declare(strict_types = 1);

namespace Source\Product;

class ProductFactory
{
    public static function build(array $data): Product
    {
        return new Product(
            (int)$data['id'],
            filter_var($data['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            (float)$data['price'],
            $data['currency']
        );
    }
}