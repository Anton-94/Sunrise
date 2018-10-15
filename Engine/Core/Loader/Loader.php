<?php

namespace Engine\Core\Loader;

use Engine\DI\DI;
use Engine\Exceptions\ModelNotFoundException;

/**
 * Class Loader
 * @package Engine\Core\Loader
 */
class Loader
{
    /**
     * Dependence injection
     * @var DI
     */
    private $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * Creates an object of the specified model
     *
     * @param $name string
     * @return object model
     * @throws ModelNotFoundException
     */
    public function model($name)
    {
        $pathToFile = ROOT_DIR . '\application\model\\' . $name . '.php';

        $model = '\Application\Model\\' . $name;
        if(file_exists($pathToFile))
        {
            return new $model($this->di);
        }else
        {
            throw new ModelNotFoundException("Model \"{$name}\" does not exists!");
        }
    }
}