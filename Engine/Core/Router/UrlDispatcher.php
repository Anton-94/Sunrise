<?php

namespace Engine\Core\Router;


class UrlDispatcher
{
    /**
     *All url requests are stored here
     *
     * @var array
     */
    private $routes = [
        'GET' => [],
        'POST' => []
    ];
    
    /**
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * Adding a pattern to the $patterns array
     *
     * @param $key
     * @param $pattern  
     */
    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * Outputs routes using the specified method
     *
     * @param $method
     * @return array|mixed
     */
    private function routes($method)
    {
        return $this->routes[$method] ?? [];
    }

    /**
     * Binds the controller to the specified url
     *
     * @param $method
     * @param $pattern
     * @param $controller
     */
    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * Changes the pattern of parameters for further replacement
     *
     * @param $pattern
     * @return null|string|string[]
     */
    private function convertPattern($pattern)
    {
        if(strpos($pattern, '{') === false)
        {
            return $pattern;
        }

        return  preg_replace_callback('#\{(\w+):(\w+)\}#', [$this, 'replacePattern'], $pattern);
    }

    /**
     * Changes the key from the $patterns array to its value
     *
     * @param $matches
     * @return string
     */
    private function replacePattern($matches)
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }

    /**
     * Removes numeric keys
     *
     * @param $params
     * @return mixed
     */
    private function processParam($params)
    {
        foreach ($params as $key => $value){
            if(is_int($key)){
                unset($params[$key]);
            }
        }
        return $params;
    }

    /**
     * Checks the current url in the $routes array
     *
     * @param $method
     * @param $uri
     * @return DispatchedRoute
     */
    public function dispatch($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));

        if(array_key_exists($uri, $routes)){
            return new DispatchedRoute($routes[$uri]);
        }

        return $this->doDispatch($method, $uri);
    }

    /**
     * @param $method
     * @param $uri
     */
    private function doDispatch($method, $uri)
    {
        foreach($this->routes($method) as $route => $controller){

            $pattern = '#^' . $route . '$#s';

            if (preg_match($pattern, $uri, $parameters)){
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }
}