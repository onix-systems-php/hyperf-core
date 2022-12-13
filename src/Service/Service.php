<?php
declare(strict_types=1);

namespace OnixSystemsPHP\HyperfCore\Service;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_CLASS)]
class Service extends AbstractAnnotation
{
}
