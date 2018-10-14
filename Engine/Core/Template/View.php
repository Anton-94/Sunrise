<?php

namespace Engine\Core\Template;

class View
{
    protected $layout = 'default';

    /**
     *
     * @param string $layouts
     */
    public function setLayout($layouts)
    {
        $this->layout = $layouts;
    }

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string $template
     * @param array  $vars
     * @throws \Exception
     */
    public function render($view, $vars = [])
    {
        $viewPath = ROOT_DIR . '/application/view/' . $view . '.php';

        if(!$viewPath)
        {
            throw new \InvalidArgumentException(
                sprintf('Template %s not found in %s', $view, $viewPath)
            );
        }

        extract($vars);
        ob_start();

        try{
            require $viewPath;
        }catch(\Exception $e){
            ob_end_clean();
            throw $e;
        }

        $content = ob_get_clean();
        require ROOT_DIR . "/application/view/layouts/$this->layout.php";
    }

    /**
     * Redirecting the user to the specified page
     * @param string $url
     */
    public function redirect($url)
    {
        return header('location:' . $url);
    }

}