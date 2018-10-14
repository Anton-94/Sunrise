<?php

use Engine\Core\Template\View;

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string $template
     * @param array  $vars
     * @throws Exception
     * @return template
     */
    function view($template, $vars = [])
    {
        $view = new View();
        $view->render($template, $vars);
    }
}