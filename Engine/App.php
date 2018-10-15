<?php

namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\Exceptions\PageNotFoundException;

class App
{
    private $di;

    public $router;
    public $request;

    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
        $this->request = $this->di->get('request');

    }

    /**
     * @throws \Exception
     */
    public function run()
    {
            require_once __DIR__ . '/Core/helpers.php';
            require_once __DIR__ . '/../configs/routes.php';

            $routerDispatch = $this->routerDispatch();

            if ($routerDispatch == null) {
                throw new PageNotFoundException();
            }

            $this->callAction($routerDispatch);
    }

    /**
     * @param DispatchedRoute object $routerDispatch
     */
    private function callAction(DispatchedRoute $routerDispatch)
    {
        list($class, $action) = explode(':', $routerDispatch->getController(), 2);

        $controller = '\Application\Controllers\\' . $class;
        $params = $routerDispatch->getParams();
        call_user_func_array([new $controller($this->di), $action], $params);
    }

    /**
     * @return object DispatchedRoute
     */
    private function routerDispatch()
    {
        $routerDispatch = $this->router->dispatch($this->request->getRealMethod(), $this->request->getUrl());

        return $routerDispatch;
    }
}