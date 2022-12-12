<?php
declare(strict_types=1);

namespace Hyperf\Core\Repository;

use Hyperf\Core\DTO\Common\PaginationRequestDTO;
use Hyperf\Core\DTO\Common\PaginationResultDTO;
use Hyperf\Core\Model\Filter\AbstractFilter;
use Hyperf\Database\Model\Builder;
use Hyperf\Database\Model\Model;

abstract class AbstractRepository
{
    private const ORDER_ASC = 'asc';
    private const ORDER_DESC = 'desc';

    protected string $modelClass = Model::class;

    public function create(array $data = []): Model
    {
        return new $this->modelClass($data);
    }

    public function query(): Builder
    {
        return $this->modelClass::query();
    }

    public function filter(AbstractFilter $filters): Builder
    {
        return $this->modelClass::filter($filters);
    }

    public function update(Model $model, array $data): Model
    {
        return $model->fill($data);
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function forceDelete(Model $model): bool
    {
        return $model->forceDelete();
    }

    public function associate(Model $model, string $relation, Model $related): Model
    {
        return $model->{$relation}()->associate($related);
    }

    public function chunk(int $count, callable $callback): void
    {
        $this->modelClass::chunk($count, $callback);
    }

    protected function paginate(Builder $query, PaginationRequestDTO $params): PaginationResultDTO
    {
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
                $query->orderBy($field, $by);
            }
        }
        $paginated = $query->paginate(
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

    protected function fetchOne(Builder $builder, bool $lock, bool $force): ?Model
    {
        if ($lock) {
            $builder = $builder->lockForUpdate();
        }
        $result = $force ? $builder->firstOrFail() : $builder->first();
        if ($result instanceof Model || is_null($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
