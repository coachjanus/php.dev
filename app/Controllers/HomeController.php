<?php declare(strict_types=1);

namespace Controllers;
use Core\Http\BaseController;

class HomeController extends BaseController 
{
    protected string $layout = "app";
   
    public function index()
    {
        $title = "Welcome to Home Page!";
        $content = $this->view()->render("index", compact("title"));
        return $content;
    }
}
