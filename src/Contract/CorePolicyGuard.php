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
