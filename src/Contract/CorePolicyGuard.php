<?php

declare(strict_types=1);
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
