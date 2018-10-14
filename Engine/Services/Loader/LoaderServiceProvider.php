<?php

namespace Engine\Services\Loader;


use Engine\Core\Loader\Loader;
use Engine\Services\AbstractProvider;

class LoaderServiceProvider extends AbstractProvider
{
    public $serviceName = 'loader';

    public function init()
    {
        $router = new Loader($this->di);
        $this->di->set($this->serviceName, $router);
    }
}