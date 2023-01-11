<?php

namespace App\Helpers;

use Closure;
use Throwable;

/**
 * add javascript promises to php , to execute certain code on certain cases
 */
final class Promise
{
    private $result;
    private $exception = null;

    private function __construct()
    {
    }
    /**
     * create new promise
     *
     * @param Closure $callback
     */
    public static function make(Closure $callback)
    {
        $promise = new static;

        $promise->try($callback);

        return $promise;
    }

    /**
     * execute closure on success
     *
     * @param Closure $callback
     * @return static
     */
    public function then(Closure $callback)
    {
        if (is_null($this->exception)) {
            $this->try($callback, $this->result);
        }

        return $this;
    }

    /**
     * execute closure when the promise result is equal the given value
     *
     * @param mixed $result
     * @param Closure $callback
     * @return static
     */
    public function if(mixed $value, Closure $callback)
    {
        if ($value === $this->result)
            call_user_func($callback, $this->result);

        elseif (is_array($value) && in_array($this->result, $value))
            call_user_func($callback, $this->result);


        return $this;
    }

    /**
     * execute closure on failure
     *
     * @param Closure $fallback
     * @return void
     */
    public function catch(Closure $fallback)
    {
        if ($this->exception instanceof Throwable) {
            call_user_func($fallback, $this->exception);
        }
    }


    /**
     * execute closure on specific failure exception
     *
     * @param string $exception
     * @param Closure $fallback
     * @return static
     */
    public function on(string $exception, Closure $fallback)
    {
        if ($this->exception instanceof $exception) {
            call_user_func($fallback, $this->exception);
        }

        return $this;
    }

    /**
     * execute closure if the promise return falsy value (false,null,'')
     *
     * @param string $exception
     * @param Closure $fallback
     * @return static
     *
     */
    public function onFalsy(Closure $fallback)
    {
        if (in_array($this->result, [false, null, ""])) {
            call_user_func($fallback, $this->result);
        }

        return $this;
    }


    private function try(Closure $callback, ...$params)
    {
        try {
            $this->result =  call_user_func($callback, ...$params);
        } catch (\Throwable $th) {
            $this->result = null;
            $this->exception = $th;
        }
    }
}
