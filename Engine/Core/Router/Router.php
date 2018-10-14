<?php

namespace Engine\Core\Router;


class Router
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var
     */
    private $dispatcher;


    /**
     * Specifying New Routes
     *
     * @param string $key
     * @param string $pattern
     * @param string $controller
     * @param string $method
     */
    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        ];
    }

    /**
     * @param $method
     * @param $uri
     * @return DispatchedRoute
     */
    public function dispatch($method, $uri)
    {
        return $this->getDispatcher()->dispatch($method, $uri);
    }

    /**
     * Splits all routes into an array of methods, routes, and patterns for parameters
     *
     * @return UrlDispatcher
     */
    public function getDispatcher()
    {
        if($this->dispatcher == null)
        {
            $this->dispatcher = new UrlDispatcher();
            foreach ($this->routes as $route){
                $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }
        return $this->dispatcher;
    }
}