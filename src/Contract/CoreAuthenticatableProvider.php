<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Contract;

interface CoreAuthenticatableProvider
{
    public function user(): null|CoreAuthenticatable;
}
