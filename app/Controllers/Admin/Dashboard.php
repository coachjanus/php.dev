<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Response;

class Dashboard extends BaseController
{
    protected string $layout = "admin";

    public function index()
    {
        $title = "Admin panel";
    
        $content = new Response($this->view()->render(view: 'admin/index', context: compact(var_name: 'title')));
        return $content;
        
    } 
}
