<?php

namespace Engine\Core\Cookies;


/**
 * Class for working with cookies
 *
 * @package Engine\Core\Cookies
 */
class Cookie
{
    /**
     * Create a new cookie.
     *
     * @param $name
     * @param $value
     * @param $time
     */
    public function setCookie($name , $value, $time, $path = '/', $domain = null, $secure = false, $httponly = false)
    {
        setcookie($name, $value, strtotime("+$time"), $path, $domain, $secure, $httponly);

        // from PHP source code
        if (preg_match("/[=,; \t\r\n\013\014]/", $name)) {
            throw new \InvalidArgumentException(sprintf('The cookie name "%s" contains invalid characters.', $name));
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('The cookie name cannot be empty.');
        }
    }

    /**
     * Create a cookie that lasts "forever" (five years).
     *
     * @param string $name
     * @param string $value
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function forever($name, $value, $path = null, $domain = null, $secure = false, $httpOnly = true)
    {
        $this->setCookie($name, $value, 2628000, $path, $domain, $secure, $httpOnly);
    }

    /**
     * Expire the given cookie.
     *
     * @param string $name
     * @param string $path
     * @param string $domain
     */
    public function forget($name, $path = null, $domain = null)
    {
        $this->setCookie($name, null, -2628000, $path, $domain);
    }

    /**
     * Displays information about a cookie
     *
     * @param $name
     * @return bool
     */
    public function getCookie($name)
    {
        return $_COOKIE[$name] ?? false;
    }

}