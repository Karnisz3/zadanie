<?php
declare(strict_types = 1);

namespace Source\Cart\Query;

class AddProductToCartQuery
{
    private int $productId;

    private int $cartId;

    public function __construct(int $productId, int $cartId)
    {
        $this->productId = $productId;
        $this->cartId = $cartId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getCartId(): int
    {
        return $this->cartId;
    }
}