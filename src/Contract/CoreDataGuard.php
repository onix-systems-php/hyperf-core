<?php

declare(strict_types=1);
namespace OnixSystemsPHP\HyperfCore\Contract;

use Hyperf\Database\Model\Builder;
use OnixSystemsPHP\HyperfCore\Repository\AbstractRepository;

interface CoreDataGuard
{
    public function specify(AbstractRepository $repository, Builder $query, string $action = 'list'): Builder;
}
