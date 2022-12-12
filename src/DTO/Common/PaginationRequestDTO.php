<?php
declare(strict_types=1);

namespace Hyperf\Core\DTO\Common;

use Hyperf\Core\DTO\AbstractDTO;

class PaginationRequestDTO extends AbstractDTO
{
    public ?int $page = null;

    public ?int $per_page = null;

    public ?array $order = null;
}
