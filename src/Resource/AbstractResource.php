<?php

declare(strict_types=1);
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
