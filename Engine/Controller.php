<?php

namespace Engine;


abstract class Controller
{
    protected $di;
    protected $view;
    protected $model;
    protected $request;
    protected $loader;

    public function __construct(\Engine\DI\DI $di)
    {
        $this->di = $di;
        $this->view = $this->di->get('view');
        $this->request = $this->di->get('request');
        $this->loader = $this->di->get('loader');
    }
}