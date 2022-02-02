<?php
declare(strict_types = 1);

namespace Source\Product\Query;

use InvalidArgumentException;

class UpdateProductQuery
{
    private int $id;
    private float $newPrice;

    public function __construct(int $id, float $newPrice)
    {
        $this->id = $id;
        $this->newPrice = $newPrice;

        $this->validate();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNewPrice(): float
    {
        return $this->newPrice;
    }

    private function validate(): void
    {
        if (!$this->newPrice || !($this->newPrice > 0)) {
            throw new InvalidArgumentException("Price is invalid");
        }
    }
}