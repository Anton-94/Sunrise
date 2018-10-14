<?php

namespace Engine\DI;

class DI
{
    private $container = [];

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return mixed|string
     */
    public function get($key)
    {
        return $this->hasKey($key);
    }

    /**
     * @param $key
     * @return mixed|string
     */
    private function hasKey($key)
    {
        return $this->container[$key] ?? '';
    }

}