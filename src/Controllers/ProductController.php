<?php
declare(strict_types = 1);

namespace Source\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ProductController
{
    public function __construct()
    {
        
    }

    public function getProductsAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        return $response;
    }

    public function addProductAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        return $response;
    }

    public function updateProductAction(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $response->getBody()->write("CONTROLLER: ROUTE ".$request->getMethod().": ".$request->getRequestTarget());

        return $response;
    }
}