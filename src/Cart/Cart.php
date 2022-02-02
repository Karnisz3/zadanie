<?php
declare(strict_types = 1);

namespace Source\Cart;

use Source\App\Arrayable;

class Cart implements Arrayable
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id
        ];
    }
}