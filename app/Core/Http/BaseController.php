<?php declare(strict_types=1);

namespace Core\Http;

use Core\Kernel;
use Core\Renderer\View;

abstract class BaseController
{
    private View $view;
    protected string $layout;

    public function __construct()
    {
        $path = Kernel::projectDir() ."/views";
        $this->view = new View(path: $path, layout: $this->layout);

    }
    protected function view(): View
    {
        return $this->view;
    }

    public static function redirect(string $location)
    {
        header("Location: http://". $_SERVER['HTTP_HOST'].$location);
        exit;
    }
}