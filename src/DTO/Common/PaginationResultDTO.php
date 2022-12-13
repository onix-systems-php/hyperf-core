<?php
declare(strict_types=1);

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
