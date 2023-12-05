<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Resource;

use Hyperf\Resource\Json\JsonResource;

abstract class AbstractResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->additional(['status' => 200]);
    }
}
