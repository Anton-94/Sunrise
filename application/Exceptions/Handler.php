<?php

namespace Application\Exceptions;

use Engine\Exceptions\ModelNotFoundException;
use Engine\Exceptions\PageNotFoundException;

class Handler
{

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Exception $exception
     * @return string template
     * @throws \Exception
     */
    public function render(\Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException || $exception instanceof PageNotFoundException) {
            return view('errors/error',[
                'errorCode' => $exception->getCode(),
                'errorMessage' => $exception->getMessage()
            ]);
        }
        if ($exception instanceof \Exception) {
            return view('errors/error',[
                'errorCode' => $exception->getCode(),
                'errorMessage' => $exception->getMessage()
            ]);
        }
    }
}