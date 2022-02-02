<?php
declare(strict_types = 1);

namespace Source\Product;

use Source\App\Arrayable;
use Source\App\Collection;

class ProductCollection implements Arrayable, Collection
{

    /**
     * @var Product[]
     */
    private array $products;

    public function toArray(): array
    {
        if (empty($this->products)) {
            return [];
        }

        $array = [];
        foreach ($this->products as $product) {
            $array[] = $product->toArray();
        }

        return $array;
    }

    public function add(Arrayable $item): Collection
    {
        if ($item instanceof Product) {
            $this->products[] = $item;
        }

        return $this;
    }
}