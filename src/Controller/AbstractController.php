<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use OpenApi\Attributes as OA;
use Psr\Container\ContainerInterface;

/**
 * Documentation Init
 * https://editor.swagger.io
 */
#[OA\Server(url: 'http://localhost/', description: 'Local Server')]
#[OA\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', in: 'header', bearerFormat: 'JWT', scheme: 'bearer')]
#[OA\Parameter(parameter: 'Pagination_per_page', name: 'per_page', in: 'query', allowEmptyValue: true, example: '20')]
#[OA\Parameter(
    parameter: 'Pagination_order',
    name: 'order[]',
    in: 'query',
    schema: new OA\Schema(type: 'array', items: new OA\Items(type: 'string')),
    example: '-id'
)]
#[OA\Parameter(parameter: 'Locale', name: 'Accept-Langueage', in: 'header', allowEmptyValue: true, example: 'en-US')]
#[OA\Schema(
    schema: 'HttpErrorCommon',
    properties: [
        new OA\Property(property: 'status', type: 'number'),
        new OA\Property(property: 'title', type: 'string'),
        new OA\Property(property: 'data', type: 'array', items: new OA\Items()),
    ]
)]
#[OA\Response(response: 200, description: 'Success')]
#[OA\Response(response: 400, description: 'Bad Request', content:
    new OA\JsonContent(ref: '#/components/schemas/HttpErrorCommon'))]
#[OA\Response(response: 401, description: 'Unauthorized', content:
    new OA\JsonContent(ref: '#/components/schemas/HttpErrorCommon'))]
#[OA\Response(response: 404, description: 'Not Found', content:
    new OA\JsonContent(ref: '#/components/schemas/HttpErrorCommon'))]
#[OA\Response(response: 422, description: 'Validation error.', content:
    new OA\JsonContent(ref: '#/components/schemas/HttpErrorCommon'))]
#[OA\Response(response: 500, description: 'Server error.', content:
    new OA\JsonContent(ref: '#/components/schemas/HttpErrorCommon'))]
abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;
}
