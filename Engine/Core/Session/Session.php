<?php

namespace Engine\Core\Session;


class Session
{

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return null
     */
    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function hasSession()
    {
        return null !== $this->session;
    }

    /**
     * @param $key
     */
    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
}