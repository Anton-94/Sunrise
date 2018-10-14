<?php

namespace Engine;

use Engine\Core\Database\QueryBuilder;
use Engine\DI\DI;

abstract class Model
{
    protected $queryBuilder;
    protected $di;
    protected $db;

    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->queryBuilder = new QueryBuilder();
    }
}