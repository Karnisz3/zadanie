<?php

use Slim\Factory\AppFactory;
use Symfony\Component\Dotenv\Dotenv;

require(__DIR__ . "./../vendor/autoload.php");

(new Dotenv())->load(__DIR__."/../.env");

$app = AppFactory::create();
(require(__DIR__."./../app/middleware.php"))($app);
(require(__DIR__."./../app/routes.php"))($app);
$app->run();

// try {
//     $pdo = new PDO("mysql:host=mysql_db;dbname=test-db", "root", "secret", [
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//     ]);
// } catch (PDOException $pdoException) {
//     echo "Database problem ocurred: </br>";
//     echo "(".$pdoException->getCode()."): ".$pdoException->getMessage()."</br>";
//     die();
// }

// try {
//     $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS Persons (
//         PersonID int,
//         LastName varchar(255),
//         FirstName varchar(255),
//         Address varchar(255),
//         City varchar(255)
//     )");
//     $stmt->execute();
// } catch (PDOException $pdoException) {
//     echo "Database problem ocurred: </br>";
//     echo "(".$pdoException->getCode()."): ".$pdoException->getMessage()."</br>";
//     die();
// }

// try {
//     $stmt = $pdo->prepare("INSERT INTO Persons VALUES (1, 'pipa', 'pipra', 'lalala', 'tralala')");
//     $stmt->execute();
// } catch (PDOException $pdoException) {
//     echo "Database problem ocurred: </br>";
//     echo "(".$pdoException->getCode()."): ".$pdoException->getMessage()."</br>";
//     die();
// }

// try {
//     $stmt = $pdo->prepare("SELECT * FROM Persons");
//     $stmt->execute();
//     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $pdoException) {
//     echo "Database problem ocurred: </br>";
//     echo "(".$pdoException->getCode()."): ".$pdoException->getMessage()."</br>";
//     die();
// }

// header("content-type: application/json");
// echo json_encode($results);