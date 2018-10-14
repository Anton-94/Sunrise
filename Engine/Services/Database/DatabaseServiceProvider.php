<?php
namespace Engine\Services\Database;

use \Engine\Services\AbstractProvider;
use \Engine\Core\Database\DB;

class DatabaseServiceProvider extends AbstractProvider
{
    public $serviceName = 'db';

    public function init()
    {
        $db = new DB();
        $this->di->set($this->serviceName, $db);
    }
}