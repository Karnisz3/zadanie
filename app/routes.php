<?php
declare(strict_types = 1);

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Source\Controllers\CartController;
use Source\Controllers\ProductController;

return function (RouteCollectorProxyInterface $app) {
    $app->get('[/]', function (RequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write($_ENV['GREETING']);
        
        return $response;
    });

    $app->group('/products', function (RouteCollectorProxyInterface $app) {
        $app->get('[/]', [ProductController::class, 'getProductsAction']);
        $app->post('[/]', [ProductController::class, 'addProductAction']);
        $app->patch('/{id:\d+}', [ProductController::class, 'updateProductAction']);
    });

    $app->group('/cart', function (RouteCollectorProxyInterface $app) {
        $app->post('[/]', [CartController::class, 'createCartAction']);
        $app->post('/{id:\d+}', [CartController::class, 'addProductToCartAction']);
        $app->get('/{id:\d+}', [CartController::class, 'getProductsInCartAction']);
    });
};