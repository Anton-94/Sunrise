<?php

namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\Exceptions\ModelNotFoundException;

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

    public function run()
    {
        try {
            require_once __DIR__ . '/Core/helpers.php';
            require_once __DIR__ . '/../configs/routes.php';

            $routerDispatch = $this->router->dispatch($this->request->getRealMethod(), $this->request->getUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\Application\Controllers\\' . $class;
            $params = $routerDispatch->getParams();
            call_user_func_array([new $controller($this->di), $action], $params);

        }catch(ModelNotFoundException $e){
            echo $e;
            exit();
        }catch(\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }
}