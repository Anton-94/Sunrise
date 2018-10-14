<?php

namespace Engine\Services\Cookies;


use Engine\Core\Cookies\Cookie;
use Engine\Services\AbstractProvider;

class CookieServiceProvider extends AbstractProvider
{
    public $serviceName = 'cookie';

    public function init()
    {
        $db = new Cookie();
        $this->di->set($this->serviceName, $db);
    }

}