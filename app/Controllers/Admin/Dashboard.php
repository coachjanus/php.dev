<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;

class Dashboard extends BaseController 
{
    protected string $layout = "admin";
   
    public function index()
    {
        $title = "Welcome to Admin Dashboard!";
        // var_dump($title);
        $content = $this->view()->render("admin/index", compact("title"));
        return $content;
    }
}
