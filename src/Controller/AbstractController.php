<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use OpenApi\Annotations as OA;
use Psr\Container\ContainerInterface;

/**
 * Documentation Init
 * https://editor.swagger.io
 *
 * @OA\Server(url="http://localhost/", description="Local Server")
 * @OA\SecurityScheme(securityScheme="bearerAuth", type="http", scheme="bearer", bearerFormat="JWT")
 *
 * Pagination
 * @OA\Parameter(parameter="Pagination_page", in="query", name="page", example="1", @OA\Schema(type="integer"))
 * @OA\Parameter(parameter="Pagination_per_page", in="query", name="per_page", example="20", @OA\Schema(type="integer"))
 * @OA\Parameter(
 *     parameter="Pagination_order",
 *     in="query",
 *     name="order[]",
 *     explode=true,
 *     example="-id",
 *     @OA\Schema(type="array", @OA\Items(type="string") )
 * )
 *
 * Headers
 * @OA\Parameter( parameter="Locale", in="header", name="Accept-Language", example="en-US", @OA\Schema(type="string"))
 *
 * Responses
 * @OA\Schema(
 *     schema="HttpErrorCommon",
 *     @OA\Property(property="status", type="number"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="data", type="array", @OA\Items),
 * )
 * @OA\Response(
 *     response=200,
 *     description="Success",
 * )
 * @OA\Response(
 *     response=400,
 *     description="Bad Request",
 *     @OA\JsonContent(ref="#/components/schemas/HttpErrorCommon")
 * )
 * @OA\Response(
 *     response=401,
 *     description="Unauthorized",
 *     @OA\JsonContent(ref="#/components/schemas/HttpErrorCommon")
 * )
 * @OA\Response(
 *     response=404,
 *     description="Not Found",
 *     @OA\JsonContent(ref="#/components/schemas/HttpErrorCommon")
 * )
 * @OA\Response(
 *     response=422,
 *     description="Validation error.",
 *     @OA\JsonContent(ref="#/components/schemas/HttpErrorCommon")
 * )
 * @OA\Response(
 *     response=500,
 *     description="Server error.",
 *     @OA\JsonContent(ref="#/components/schemas/HttpErrorCommon")
 * )
 */
abstract class AbstractController
{
    #[Inject]
    protected ContainerInterface $container;

    #[Inject]
    protected RequestInterface $request;

    #[Inject]
    protected ResponseInterface $response;
}
