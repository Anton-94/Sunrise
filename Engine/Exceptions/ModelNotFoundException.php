<?php

namespace Engine\Exceptions;


class ModelNotFoundException extends \Exception
{
    public function __construct($message = 'ModelNotFountException', $code = 404, \Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASs__ . ": [{$this->code}]  {$this->message}\n";
    }
}