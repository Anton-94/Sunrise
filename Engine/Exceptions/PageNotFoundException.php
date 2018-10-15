<?php

namespace Engine\Exceptions;


class PageNotFoundException extends \Exception
{
    public function __construct($message = 'Page not found!', $code = 404, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        header("HTTP/1.x 404 Not Found");
    }

    public function __toString()
    {
        return __CLASs__ . ": [{$this->code}]  {$this->message}\n";
    }
}