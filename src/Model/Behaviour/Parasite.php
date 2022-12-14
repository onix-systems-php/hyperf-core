<?php
declare(strict_types=1);

namespace OnixSystemsPHP\HyperfCore\Model\Behaviour;

use BadMethodCallException;
use Closure;
use Hyperf\Utils\Str;

trait Parasite
{
    protected static array $externalMethods = [];

    protected static array $staticExternalMethods = [];

    public static function __callStatic($method, $parameters)
    {
        if (isset(static::$staticExternalMethods[$method])) {
            $closure = Closure::bind(static::$staticExternalMethods[$method], null, static::class);
            return call_user_func_array($closure, $parameters);
        }
        if (method_exists(static::class, '__callStaticAfter')) {
            return static::__callStaticAfter($method, $parameters);
        }
        if (method_exists(parent::class, '__callStatic')) {
            return parent::__callStatic($method, $parameters);
        }
        throw new BadMethodCallException('Method ' . static::class . '::' . $method . '() not found');
    }

    public static function addStaticExternalMethod(string $name, Closure $method): void
    {
        static::$staticExternalMethods[$name] = $method;
    }

    public static function addExternalMethod(string $name, Closure $method): void
    {
        static::$externalMethods[$name] = $method;
    }

    public function __call($method, $parameters)
    {
        if (isset(static::$externalMethods[$method])) {
            $closure = Closure::bind(static::$externalMethods[$method], $this, static::class);
            return call_user_func_array($closure, $parameters);
        }
        if (method_exists($this, '__callAfter')) {
            return $this->__callAfter($method, $parameters);
        }
        if (method_exists(parent::class, '__call')) {
            return parent::__call($method, $parameters);
        }
        throw new BadMethodCallException('Method ' . static::class . '::' . $method . '() not found');
    }

    public function hasGetMutator($key)
    {
        if (isset(static::$externalMethods['get' . Str::studly($key) . 'Attribute'])) {
            return true;
        }
        return parent::hasGetMutator($key);
    }

    public function hasSetMutator($key)
    {
        if (isset(static::$externalMethods['set' . Str::studly($key) . 'Attribute'])) {
            return true;
        }
        return parent::hasSetMutator($key);
    }

    public function getRelationValue($key)
    {
        if ($this->relationLoaded($key)) {
            return $this->relations[$key];
        }
        if (isset(static::$externalMethods[$key])) {
            return $this->getRelationshipFromMethod($key);
        }
        if (method_exists($this, $key)) {
            return $this->getRelationshipFromMethod($key);
        }
    }
}
