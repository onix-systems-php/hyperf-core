<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Contract;

use OnixSystemsPHP\HyperfCore\Exception\BusinessException;

interface CorePolicyGuard
{
    /**
     * @throws BusinessException
     */
    public function check(string $attribute, mixed $subject, array $options = []): void;

    public function justCheck(string $attribute, mixed $subject, array $options = []): bool;
}
