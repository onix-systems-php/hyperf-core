<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Model;

use Hyperf\Database\Model\Builder as BaseBuilder;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;
use OnixSystemsPHP\HyperfCore\DTO\Common\PaginationRequestDTO;
use OnixSystemsPHP\HyperfCore\DTO\Common\PaginationResultDTO;
use OnixSystemsPHP\HyperfCore\Model\Filter\AbstractFilter;
use OnixSystemsPHP\HyperfCore\Repository\HasRepository;

/**
 * @method Builder filter(AbstractFilter $filters)
 */
class Builder extends BaseBuilder
{
    use HasRepository;

    public function __call($method, $parameters): mixed
    {
        if (isset($this->repository) && method_exists($this->repository, $scope = 'scope' . ucfirst($method))) {
            return $this->callScope([$this->repository, $scope], $parameters);
        }

        return parent::__call($method, $parameters);
    }

    public function finder(string $type, ...$parameters): self
    {
        if (isset($this->repository) && method_exists($this->repository, $scope = 'scope' . ucfirst($type))) {
            return $this->callScope([$this->repository, $scope], $parameters);
        }

        return $this;
    }

    public function fetchOne(bool $lock, bool $force): ?Model
    {
        $query = $this;
        if ($this->repository?->processGuards && $this->repository->getDataGuard()) {
            $query = $this->repository?->getDataGuard()->specify($this->repository, $query, 'fetch');
        }
        if ($lock) {
            $query = $query->lockForUpdate();
        }
        $result = $force ? $query->firstOrFail() : $query->first();
        if ($result instanceof Model || is_null($result)) {
            return $result;
        }

        return null;
    }

    public function get($columns = ['*']): array|Collection
    {
        $this->guardList();

        return parent::get($columns);
    }

    public function chunk($count, callable $callback)
    {
        $this->guardList();

        return parent::chunk($count, $callback);
    }

    public function chunkById($count, callable $callback, $column = null, $alias = null)
    {
        $this->guardList();

        return parent::chunkById($count, $callback, $column, $alias);
    }

    public function each(callable $callback, $count = 1000)
    {
        $this->guardList();

        return parent::each($callback, $count);
    }

    public function paginateDTO(PaginationRequestDTO $params): PaginationResultDTO
    {
        $this->guardList();
        $page = $params->page ?? 1;
        $per_page = $params?->per_page ?? 20;
        $by = 'ASC';
        if (is_array($params->order)) {
            foreach ($params->order as $item) {
                if (str_starts_with($item, '-')) {
                    $by = 'DESC';
                    $column = substr($item, 1);
                } else {
                    $column = $item;
                }
                if (in_array($column, $this->model->fillable, true)) {
                    $this->orderByRaw("$column $by NULLS LAST");
                }
            }
        }
        $paginated = $this->paginate($per_page, page: $page);
        $total = $paginated->total();

        return PaginationResultDTO::make([
            'list' => $paginated->items(),
            'total' => $total,
            'page' => $page,
            'per_page' => $per_page,
            'total_pages' => $per_page != 0 ? ceil($total / $per_page) : 0,
        ]);
    }

    protected function guardList(): void
    {
        if ($this->repository?->processGuards) {
            $this->repository->getDataGuard()?->specify($this->repository, $this);
        }
    }
}
