<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Contract;

interface CoreAuthenticatable
{
    public function getId();

    public function getRole(): string;
}
