<?php
declare(strict_types = 1);

namespace Source\Product;

use InvalidArgumentException;
use PDOException;
use Source\App\AbstractRepository;
use Source\Product\Query\UpdateProductQuery;

class ProductRepository extends AbstractRepository
{
    public function fetchAllProducts(): ProductCollection
    {
        $stmt = $this->pdo->prepare(
            "SELECT product_id as id,
                    title as title,
                    price as price,
                    currency as currency
            FROM products"
        );
        
        $stmt->execute();

        $products = $stmt->fetchAll();

        $productCollection = new ProductCollection();
        foreach ($products as $product) {
            $productCollection->add(ProductFactory::build($product));
        }

        return $productCollection;
    }

    public function addNewProduct(Product $product): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO products (title, price, currency)
            VALUES ('{$product->getTitle()}', {$product->getPrice()}, '{$product->getCurrency()}')"
        );
        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            if (intval($e->getCode()) === 23000) {
                throw new InvalidArgumentException("A product with this title already exists");
            } else {
                throw $e;
            }
        }
    }

    public function updateProductPriceById(UpdateProductQuery $updateProductQuery)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE products 
            SET price = :price 
            WHERE product_id = :id"
        );

        $stmt->execute([
            'price' => $updateProductQuery->getNewPrice(),
            'id' => $updateProductQuery->getId()
        ]);

        if ($stmt->rowCount() < 1) {
            throw new InvalidArgumentException("Product with this ID doesn't exist");
        }
    }
}