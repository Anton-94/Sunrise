<?php

namespace Application\Controllers;


class ErrorController
{
    public function page404()
    {
        http_response_code(404);
        require ROOT_DIR . '/application/View/errors/404.php';
    }
}