<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
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
