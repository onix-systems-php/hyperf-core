<?php

declare(strict_types=1);
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

    private const ORDER_ASC = 'asc';

    private const ORDER_DESC = 'desc';

    public function __call($method, $parameters): self
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
        if ($this->repository?->getDataGuard()) {
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

    public function get($columns = ['*']): Collection|array
    {
        $this->guardList();
        return parent::get($columns);
    }

    public function chunk(int $count, callable $callback): bool
    {
        $this->guardList();
        return parent::chunk($count, $callback);
    }

    public function chunkById($count, callable $callback, ?string $column = null, ?string $alias = null): bool
    {
        $this->guardList();
        return parent::chunkById($count, $callback, $column, $alias);
    }

    public function each(callable $callback, int $count = 1000): bool
    {
        $this->guardList();
        return parent::each($callback, $count);
    }

    public function paginateDTO(PaginationRequestDTO $params): PaginationResultDTO
    {
        $this->guardList();
        $page = $params?->page ?? 1;
        $per_page = $params?->per_page ?? 20;
        if (is_array($params?->order)) {
            foreach ($params->order as $item) {
                if (str_starts_with($item, '-')) {
                    $by = self::ORDER_DESC;
                    $field = substr($item, 1);
                } else {
                    $by = self::ORDER_ASC;
                    $field = $item;
                }
                $this->orderBy($field, $by);
            }
        }
        $paginated = $this->paginate(
            perPage: $per_page,
            page: $page,
        );
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
        $this->repository?->getDataGuard()?->specify($this->repository, $this);
    }
}
