<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Contract;

interface CoreAuthenticatableProvider
{
    public function user(): CoreAuthenticatable|null;
}
