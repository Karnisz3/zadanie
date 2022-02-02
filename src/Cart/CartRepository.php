<?php
declare(strict_types = 1);

namespace Source\Cart;

use InvalidArgumentException;
use PDOException;
use Source\App\AbstractRepository;
use Source\Cart\Query\AddProductToCartQuery;
use Source\Product\ProductCollection;
use Source\Product\ProductFactory;

class CartRepository extends AbstractRepository
{
    public function createNewCart(): Cart
    {
        $stmt = $this->pdo->prepare("INSERT INTO carts VALUES ()");
        $stmt->execute();

        return new Cart(intval($this->pdo->lastInsertId()));
    }

    public function addProductToCart(AddProductToCartQuery $addProductToCartQuery): void
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO orders (product_id, cart_id) VALUES (:product, :cart)");
            $stmt->execute([
                'product' => $addProductToCartQuery->getProductId(),
                'cart' => $addProductToCartQuery->getCartId()
            ]);
        } catch (PDOException $e) {
            if (intval($e->getCode()) === 23000) {
                throw new InvalidArgumentException("Product or cart with this ID doesn't exist");
            } else {
                throw $e;
            }
        }
    }

    public function getProductsInCart(int $cartId): ProductCollection
    {
        $stmt = $this->pdo->prepare(
            "SELECT p.product_id AS id,
                    p.title AS title,
                    p.price AS price,
                    p.currency AS currency
            FROM orders o
            LEFT JOIN products p ON o.product_id = p.product_id
            WHERE o.cart_id = :cartId"
        );
        $stmt->execute([
            'cartId' => $cartId
        ]);
        $products = $stmt->fetchAll();

        $productCollection = new ProductCollection();
        foreach ($products as $product) {
            $productCollection->add(ProductFactory::build($product));
        }

        return $productCollection;
    }

    public function getCartValue(int $cartId): float
    {
        $stmt = $this->pdo->prepare(
            "SELECT SUM(p.price) as cartValue
            FROM orders o
            LEFT JOIN products p ON o.product_id = p.product_id
            WHERE o.cart_id = :cartId
            GROUP BY o.cart_id"
        );
        $stmt->execute([
            'cartId' => $cartId
        ]);

        return floatval($stmt->fetch()['cartValue']);
    }
}