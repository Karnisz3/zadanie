<?php
declare(strict_types = 1);

namespace Source\Product;

use InvalidArgumentException;
use Source\App\Arrayable;

class Product implements Arrayable
{
    private int $id;

    private string $title;

    private float $price;

    private string $currency;

    public function __construct(int $id, string $title, float $price, string $currency)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->currency = $currency;

        $this->validate();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getPriceString(): string
    {
        return $this->price . " " . $this->currency;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'currency' => $this->currency,
            'priceString' => $this->getPriceString()
        ];
    }

    private function validate(): void
    {
        if (!$this->title || strlen($this->title) < 3) {
            throw new InvalidArgumentException("Title is requires and must have at least 3 characters");
        }

        if (!$this->price || $this->price < 0) {
            throw new InvalidArgumentException("Price is invalid");
        }

        if (!$this->currency || !in_array($this->currency, ProductConst::ALLOWED_CURRENCIES)) {
            throw new InvalidArgumentException("Currency can only be USD for now");
        }
    }
}