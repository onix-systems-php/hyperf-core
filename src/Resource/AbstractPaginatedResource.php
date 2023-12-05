<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Resource;

use OnixSystemsPHP\HyperfCore\DTO\Common\PaginationResultDTO;

/**
 * @method __construct(PaginationResultDTO $resource)
 * @property PaginationResultDTO $resource
 */
abstract class AbstractPaginatedResource extends AbstractResource
{
    /**
     * Transform the resource into an array.
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
