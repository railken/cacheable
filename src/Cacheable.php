<?php

namespace Railken\Cacheable;

use Illuminate\Support\Facades\Cache;
use Closure;

class Cacheable
{
    /**
     * Create a new Cacheable instance
     *
     * @return Cacheable
     */
    public static function make(): Cacheable
    {
        return new self;
    }

    /**
     * Create a new Cacheable instance
     *
     * @param CacheableContract $obj
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function try(CacheableContract $obj, string $method, array $args = [])
    {
        $name = $this->name(get_class($obj), $method, $args);
        $method = $this->parseMethod($method);

        $closure = function() use ($method, $args, $obj) {
            return $obj->$method(...$args);
        };

        return $this->remember($name, $closure);
    }


    /**
     * Create a new Cacheable instance
     *
     * @param string $class
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function tryStatic(string $class, string $method, array $args = [])
    {
        $name = $this->name($class, $method, $args);
        $method = $this->parseMethod($method);

        $closure = function() use ($method, $args, $class) {
            return $class::$method(...$args);
        };

        return $this->remember($name, $closure);
    }

    /**
     * Is a valid method for Cacheable?
     *
     * @param string $class
     * @param string $method
     *
     * @return bool
     */
    public function isValidCall(string $class, string $method): bool
    {
        return preg_match('/Cached$/', $method) && class_exists($class, $this->parseMethod($method));
    }

    /**
     * Parse method before calling
     *
     * @param string $method
     *
     * @return string
     */
    public function parseMethod(string $method): string
    {
        return preg_replace('/Cached$/', '', $method);
    }

    /**
     * Remember the function
     *
     * @param string $name
     * @param Closure $closure
     *
     * @return mixed
     */
    public function remember(string $name, Closure $closure)
    {
        return Cache::rememberForever($name, $closure);
    }

    /**
     * Calculate the key cache
     * 
     * @param string $class
     * @param string $method
     * @param array $args
     *
     * @return string
     */
    public function name(string $class, string $method, array $args = []): string
    {
        return sprintf("%s::%s::%s", $class, $method, serialize($args));
    }

}
