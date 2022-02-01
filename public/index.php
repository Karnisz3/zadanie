<?php

use Slim\Factory\AppFactory;
use Symfony\Component\Dotenv\Dotenv;

/** Autoload files */
require(__DIR__ . "./../vendor/autoload.php");

/** Load env varialbes */
if (file_exists(__DIR__ . "/../.env")) {
    (new Dotenv())->load(__DIR__ . "/../.env");
}

/** Add container definition, build app */
$app = AppFactory::createFromContainer(
    require(__DIR__."./../app/container.php")
);

/** Add middleware */
(require(__DIR__."./../app/middleware.php"))($app);

/** Define routes */
(require(__DIR__."./../app/routes.php"))($app);

/** Run the app */
$app->run();
