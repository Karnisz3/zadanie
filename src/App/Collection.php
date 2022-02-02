<?php
declare(strict_types = 1);

namespace Source\App;

use Source\App\Arrayable;

interface Collection
{
    public function add(Arrayable $item): self;
}