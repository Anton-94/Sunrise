<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    Engine\Services\Database\DatabaseServiceProvider::class,
    Engine\Services\Router\RouterServiceProvider::class,
    Engine\Services\View\ViewServiceProvider::class,
    Engine\Services\Request\RequestServiceProvider::class,
    Engine\Services\Loader\LoaderServiceProvider::class,
];