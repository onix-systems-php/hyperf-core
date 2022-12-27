<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Resource;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  schema="ResourceSuccess",
 *  type="array",
 *  @OA\Items(type="string"),
 * )
 * @method __construct()
 * @property null $resource
 */
class ResourceSuccess extends AbstractResource
{
}
