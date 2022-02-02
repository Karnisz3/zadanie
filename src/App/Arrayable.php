<?php
declare(strict_types = 1);

namespace Source\App;

interface Arrayable
{
    /**
     * Converst a DTO to an array
     */
    public function toArray(): array;
}