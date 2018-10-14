<?php

namespace Engine\Services\Router;

use\Engine\Services\AbstractProvider;
use \Engine\Core\Router\Router;

class RouterServiceProvider extends AbstractProvider
{
    public $serviceName = 'router';

    public function init()
    {
        $router = new Router();
        $this->di->set($this->serviceName, $router);
    }
}