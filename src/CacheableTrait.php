<?php

namespace Railken\Cacheable;

use Illuminate\Support\Facades\Cache;

trait CacheableTrait
{
    /**
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $args = [])
    {
        $cacheable = self::cacheable();

        if ($cacheable->isValidCall(__CLASS__, $method)) {
            return $cacheable->tryStatic(__CLASS__, $method, $args);
        } else {
            trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
        }
    }

    /**
     * @param string $method
     * @param array $args
     *
     * @return mixed
     */
    public function __call(string $method, array $args = [])
    {
        $cacheable = self::cacheable();

        if ($cacheable->isValidCall(get_class($this), $method)) {
            return $cacheable->try($this, $method, $args);
        } else {
            trigger_error('Call to undefined method '.__CLASS__.'::'.$method.'()', E_USER_ERROR);
        }
    }

    /**
     * @return Cacheable
     */
    public static function cacheable(): Cacheable
    {
        return Cacheable::make();
    }
}
