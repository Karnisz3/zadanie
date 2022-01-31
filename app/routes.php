<?php
declare(strict_types = 1);

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;

return function (RouteCollectorProxyInterface $app) {
    $app->get('[/]', function (RequestInterface $request, ResponseInterface $response) {
        $response->getBody()->write($_ENV['GREETING']);
        
        return $response;
    });

    $app->group('/products', function (RouteCollectorProxyInterface $app) {
        $app->get('[/]', function (RequestInterface $request, ResponseInterface $response) {
            // get all products
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
        $app->post('[/]', function (RequestInterface $request, ResponseInterface $response) {
            // add a new product
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
        $app->patch('/{id:[0-9]+}', function (RequestInterface $request, ResponseInterface $response) {
            //patch a existing product
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
    });

    $app->group('/cart', function (RouteCollectorProxyInterface $app) {
        $app->post('[/]', function (RequestInterface $request, ResponseInterface $response) {
            // create new empty cart, return 200 OK and carn ID
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
        $app->post('/{id:\d+}', function (RequestInterface $request, ResponseInterface $response) {
            // add a product to a cart with a given ID
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
        $app->get('/{id:\d+}', function (RequestInterface $request, ResponseInterface $response) {
            // list all product in a given cart
            $response->getBody()->write("ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

            return $response;
        });
    });
};