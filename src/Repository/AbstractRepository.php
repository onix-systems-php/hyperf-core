<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Repository;

use Hyperf\Database\Model\Model;
use OnixSystemsPHP\HyperfCore\Contract\CoreDataGuard;
use OnixSystemsPHP\HyperfCore\Model\AbstractModel;
use OnixSystemsPHP\HyperfCore\Model\Builder;

/**
 * @method null|AbstractModel fetchOne(bool $lock, bool $force) use only for type hint
 */
abstract class AbstractRepository
{
    public bool $processGuards = true;

    protected string $modelClass = AbstractModel::class;

    public function __construct(
        protected ?CoreDataGuard $dataGuard,
    ) {}

    public function query(): Builder
    {
        /** @var Builder $builder */
        $builder = $this->modelClass::query();
        return $builder->setRepository($this);
    }

    public function create(array $data = []): Model
    {
        return new $this->modelClass($data);
    }

    public function update(Model $model, array $data): Model
    {
        return $model->fill($data);
    }

    public function save(Model $model): bool
    {
        return $model->save();
    }

    public function push(Model $model): bool
    {
        return $model->push();
    }

    public function firstOrCreate(array $attributes, array $values = []): Model
    {
        return $this->modelClass::firstOrCreate($attributes, $values);
    }

    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->modelClass::updateOrCreate($attributes, $values);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function forceDelete(Model $model): bool
    {
        return $model->forceDelete();
    }

    public function restore(Model $model): bool
    {
        return $model->restore();
    }

    public function associate(Model $model, string $relation, Model $related): Model
    {
        return $model->{$relation}()->associate($related);
    }

    public function finder(string $type, ...$parameters): AbstractRepository|Builder
    {
        return $this->query()->finder($type, ...$parameters);
    }

    public function scopeTrashed(Builder $query, string $type): void
    {
        if ($type === 'all') {
            $query->withTrashed();
        } elseif ($type === 'trashed') {
            $query->onlyTrashed();
        }
    }

    public function getModelClass(): string
    {
        return $this->modelClass;
    }

    public function getDataGuard(): ?CoreDataGuard
    {
        return $this->dataGuard;
    }

    public function getChanges(AbstractModel $data): array
    {
        $fieldsToSkipValue = array_flip($data->getHidden());
        if (property_exists($data, 'fileRelations')) {
            $fieldsToSkipValue = array_merge($fieldsToSkipValue, $data->fileRelations);
        }
        $changes = $data->getDirty();
        unset($changes[$data->getUpdatedAtColumn()]);

        $result = [];

        foreach ($changes as $key => $value) {
            if (array_key_exists($key, $fieldsToSkipValue)) {
                $result[$key] = 'changed';
            } else {
                $result[$key] = [
                    'cur' => $value,
                    'prev' => $data->getOriginal($key),
                ];
            }
        }

        return $result;
    }
}
