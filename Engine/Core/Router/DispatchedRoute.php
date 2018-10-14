<?php

namespace Engine\Core\Router;


class DispatchedRoute
{
    private $controller;
    private $params;

    /**
     * DispatchedRoute constructor.
     *
     * @param string $controller
     * @param array $params
     */
    public function __construct($controller, $params = [])
    {
        $this->controller = $controller;
        $this->params = $params;
    }

    /**
     * Gets specified controller
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Gets specified parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}