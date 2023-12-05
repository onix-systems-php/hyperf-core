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

namespace OnixSystemsPHP\HyperfCore\Repository;

trait HasRepository
{
    protected null|AbstractRepository $repository = null;

    public function setRepository(AbstractRepository $repository): self
    {
        $this->repository = $repository;
        return $this;
    }
}
