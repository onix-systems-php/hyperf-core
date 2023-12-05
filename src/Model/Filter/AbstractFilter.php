<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\Model\Filter;

use Hyperf\Stringable\Str;
use OnixSystemsPHP\HyperfCore\Model\Builder;
use OnixSystemsPHP\HyperfCore\Repository\HasRepository;

abstract class AbstractFilter
{
    use HasRepository;

    protected Builder $builder;

    public function __construct(protected array $filters) {}

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array) $value);
            }
        }
    }

    protected function fields(): array
    {
        return array_filter(
            array_map(function (mixed $item) {
                return is_string($item) ? trim($item) : $item;
            }, $this->filters)
        );
    }
}
