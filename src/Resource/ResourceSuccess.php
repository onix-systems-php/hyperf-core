<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Resource;

use OpenApi\Attributes as OA;

/**
 * @method __construct()
 * @property null $resource
 */
#[OA\Schema(schema: 'ResourceSuccess', type: 'array', items: new OA\Items(type: 'string'))]
class ResourceSuccess extends AbstractResource {}
