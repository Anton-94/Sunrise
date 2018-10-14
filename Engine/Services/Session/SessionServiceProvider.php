<?php
namespace Engine\Services\Session;

use Engine\Core\Cookies\Cookie;
use Engine\Services\AbstractProvider;

class SessionServiceProvider extends AbstractProvider
{
    public $serviceName = 'session';

    public function init()
    {
        $db = new Cookie();
        $this->di->set($this->serviceName, $db);
    }

}