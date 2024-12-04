<?php declare(strict_types=1);

namespace Controllers;

use Core\Http\BaseController;

class AboutController extends BaseController
{
    protected string $layout = "app";

    public function index(): string
    {
        $title = "About page";
        return $this->view()->render(view: 'about', context: compact(var_name: 'title'));
    } 
 
}
