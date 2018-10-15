<?php

use Application\Exceptions\Handler;
use Engine\App;
use Engine\DI\DI;

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/

try{

    $di = new DI();

    $dotenv = new \Dotenv\Dotenv(ROOT_DIR);
    $dotenv->load();

    $services = require_once ROOT_DIR . '\configs\service.php';

    foreach ($services as $service){
        $provider = new $service($di);
        $provider->init();
    }


    $app = new App($di);
    $app->run();

}catch(\Exception $e){
    $handle = new Handler();
    $handle->render($e);
}