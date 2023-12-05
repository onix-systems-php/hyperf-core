<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Service;

use Hyperf\Di\Annotation\AbstractAnnotation;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Service extends AbstractAnnotation
{
    public function __construct() {}
}
