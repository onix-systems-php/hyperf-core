<?php

declare(strict_types=1);
/**
 * This file is part of the extension library for Hyperf.
 *
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace OnixSystemsPHP\HyperfCore\DTO;

use ClassTransformer\ClassTransformer;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Validation\Request\FormRequest;

abstract class AbstractDTO
{
    public static function make(array|RequestInterface $data): static
    {
        if ($data instanceof FormRequest) {
            $data = $data->validated();
        } elseif ($data instanceof RequestInterface) {
            $data = $data->all();
        }
        return ClassTransformer::transform(static::class, $data);
    }

    public function toArray(): array
    {
        return array_map(static function ($item) {
            if ($item instanceof AbstractDTO) {
                return $item->toArray();
            }

            if (is_array($item)) {
                return array_map(static fn ($arr) => $arr instanceof AbstractDTO ? $arr->toArray() : $arr, $item);
            }

            return $item;
        }, (array) $this);
    }
}
