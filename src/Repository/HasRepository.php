<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Repository;

trait HasRepository
{
    protected AbstractRepository | null $repository = null;

    public function setRepository(AbstractRepository $repository): self
    {
        $this->repository = $repository;
        return $this;
    }
}
