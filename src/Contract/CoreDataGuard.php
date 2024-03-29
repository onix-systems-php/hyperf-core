<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Contract;

use Hyperf\Database\Model\Builder;
use OnixSystemsPHP\HyperfCore\Repository\AbstractRepository;

interface CoreDataGuard
{
    public function specify(AbstractRepository $repository, Builder $query, string $action = 'list'): Builder;
}
