<?php

namespace Application\Model;


use Engine\Core\Database\CRUD;
use Engine\Model;

class User extends Model
{
    use CRUD;

    public function __construct($di)
    {
        parent::__construct($di);

        $this->setTable('users');
    }
}