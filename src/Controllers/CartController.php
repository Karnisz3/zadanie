<?php
declare(strict_types = 1);

namespace Source\Controllers;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\App\AbstractController;
use Source\Cart\CartRepository;
use Source\Cart\Query\AddProductToCartQuery;

class CartController extends AbstractController
{
    private CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function createCartAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            $newCart = $this->cartRepository->createNewCart();
            $response->withHeader(201, "Created");
        } catch (Exception $e) {
            return $this->sendError($response, $e);
        }

        return $this->sendJson($response, $newCart);
    }

    public function addProductToCartAction(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $addProductToCartQuery = new AddProductToCartQuery(
                intval($this->parseRequestBody($request)['id']),
                intval($args['id'])
            );
            $this->cartRepository->addProductToCart($addProductToCartQuery);
        } catch (Exception $e) {
            return $this->sendError($response, $e);
        }

        return $response;
    }

    public function getProductsInCartAction(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $products = $this->cartRepository->getProductsInCart(intval($args['id']));
        $cartValue = $this->cartRepository->getCartValue(intval($args['id']));

        return $this->sendJson($response, [
            'products' => $products->toArray(),
            'totalPrice' => $cartValue
        ]);
    }
}