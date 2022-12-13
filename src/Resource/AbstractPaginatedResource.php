<?php
declare(strict_types=1);

namespace Hyperf\Core\Resource;

use Hyperf\Core\DTO\Common\PaginationResultDTO;

/**
 * @method __construct(PaginationResultDTO $resource)
 * @property PaginationResultDTO $resource
 */
abstract class AbstractPaginatedResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'list' => [],
            'total' => $this->resource->total,
            'page' => $this->resource->page,
            'per_page' => $this->resource->per_page,
            'total_pages' => $this->resource->total_pages,
        ];
    }
}
