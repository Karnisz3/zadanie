<?php
declare(strict_types = 1);

namespace Source\App;

use PDO;

abstract class AbstractRepository
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}