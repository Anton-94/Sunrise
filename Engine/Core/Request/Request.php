<?php

namespace Engine\Core\Request;


class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    /**
     *
     * @param $key
     * @return mixed
     */
    public function post($key)
    {
        return $_POST[$key];
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $_GET[$key];
    }

    /**
     * Check whether a request is POST
     *
     * @return bool
     */
    public function isPOST(): bool
    {
        if($_SERVER['REQUEST_METHOD'] == self::METHOD_POST){
            return true;
        }
        return false;
    }

    /**
     * Gets the "real" request method.
     *
     * @return string The request method
     */
    public function getRealMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);

    }

    /**
     * Gets the current url without parameters
     *
     * @return string
     */
    public function getUrl():string
    {
        $url = $_SERVER['REQUEST_URI'];

        if($position = strpos($url,'?')){
            $url = substr($url,0,$position);
        }

        return $url;
    }

}