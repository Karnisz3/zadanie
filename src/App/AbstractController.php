<?php
declare(strict_types = 1);

namespace Source\App;

use Exception;
use InvalidArgumentException;
use PDOException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractController
{

    protected function sendJson(ResponseInterface $response, Arrayable $data): ResponseInterface
    {
        $response->withHeader("Content-Type", "application/json");

        if (empty($data)) {
            $response->withStatus(204, "No Content");
        } else {
            $response->getBody()->write(json_encode($data->toArray()));
            $response->withStatus(200, "OK");
        }

        return $response;
    }

    protected function sendError(ResponseInterface $response, Exception $exception): ResponseInterface
    {
        $response->withHeader("Content-Type", "application/json");

        if ($exception instanceof InvalidArgumentException) {
            $response->getBody()->write(json_encode(['error' => $exception->getMessage()]));
            $response->withStatus(400, "Bad Request");
        } else if ($exception instanceof PDOException) {
            $response->getBody()->write(json_encode(['error' => "Internal Database problem"]));
            $response->withStatus(500, "Internal Servel Error");
        } else {
            $response->getBody()->write(json_encode(['error' => "Internal API problem"]));
            $response->withStatus(500, "Internal Servel Error");
        }

        return $response;
    }

    protected function parseRequestBody(RequestInterface $request): array
    {
        $body = $request->getBody()->getContents();

        return json_decode($body, true) ?? [];
    }
}