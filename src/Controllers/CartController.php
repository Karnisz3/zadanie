<?php
declare(strict_types = 1);

namespace Source\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\App\AbstractController;

class CartController extends AbstractController
{
    public function createCartAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        return $response;
    }

    public function addProductToCartAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        return $response;
    }

    public function getProductsInCartAction(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        var_dump($args);

        return $response;
    }
}