<?php

namespace Engine\Services\Request;


use Engine\Core\Request\Request;
use Engine\Services\AbstractProvider;

class RequestServiceProvider extends AbstractProvider
{
    public $serviceName = 'request';

    public function init()
    {
        $router = new Request();
        $this->di->set($this->serviceName, $router);
    }
}