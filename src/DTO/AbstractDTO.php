<?php

declare(strict_types=1);
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
        return array_map(function ($item) {
            if ($item instanceof AbstractDTO) {
                return $item->toArray();
            } else {
                return $item;
            }
        }, (array)$this);
    }
}
