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

namespace OnixSystemsPHP\HyperfCore\DTO\Common;

use OnixSystemsPHP\HyperfCore\DTO\AbstractDTO;

class PaginationResultDTO extends AbstractDTO
{
    public array $list;

    public int $page;

    public int $per_page;

    public int $total;

    public int $total_pages;
}
