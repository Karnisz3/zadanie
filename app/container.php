<?php
declare(strict_types = 1);

use DI\ContainerBuilder;

return (new ContainerBuilder())->addDefinitions([
    "database" => function () {
        $dsn = sprintf("%s:host=%s;dbname=%s", $_ENV['DB_ENGINE'], $_ENV['DB_HOST'], $_ENV['DB_NAME']);
        $params = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $params);
        } catch (PDOException $pdoEx) {
            echo "Database problem ocurred\n";
            echo $pdoEx->getMessage();
            die();
        }

        return $pdo;
    }
])->build();