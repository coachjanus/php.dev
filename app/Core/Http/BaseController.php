<?php declare(strict_types=1);

namespace Core\Http;

use Core\Kernel;
use Core\Renderer\View;

class BaseController
{
    private View $view;
    protected string $layout;
    // protected string $config;
    public function __construct() 
    {
        $templates = Kernel::projectDir()."/views";
        $this->view = new View(path: $templates, layout: $this->layout);
    }

    public static function redirect($location)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].$location);
        exit();
    }
    protected function view(): View
    {
        return $this->view;
    }
}
