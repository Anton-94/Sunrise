<?php
namespace Engine\Services;

abstract class AbstractProvider
{
    protected $di;

    public function __construct(\Engine\DI\DI $di)
    {
        $this->di = $di;
    }

    /**
     * Initialization of the services in the di container
     *
     * @return mixed
     */
    abstract function init();
}