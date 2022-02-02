<?php
declare(strict_types = 1);

namespace Source\Controllers;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Source\App\AbstractController;
use Source\Product\ProductFactory;
use Source\Product\ProductRepository;
use Source\Product\Query\UpdateProductQuery;

class ProductController extends AbstractController
{

    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductsAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            $productCollection = $this->productRepository->fetchAllProducts();
        } catch (Exception $e) {
            return $this->sendError($response, $e);
        }

        return $this->sendJson($response, $productCollection);
    }

    public function addProductAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $body = $this->parseRequestBody($request);

        try {
            $this->productRepository->addNewProduct(ProductFactory::build($body));
        } catch (Exception $e) {
            return $this->sendError($response, $e);
        }

        return $response->withStatus(201, "Created");
    }

    public function updateProductAction(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        try {
            $updateProductQuery = new UpdateProductQuery(
                intval($args['id']),
                floatval($this->parseRequestBody($request)['price'])
            );
            $this->productRepository->updateProductPriceById($updateProductQuery);
        } catch (Exception $e) {
            return $this->sendError($response, $e);
        }

        return $response->withStatus(200, "OK");
    }
}
