<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;


class Dashboard extends BaseController
{
    protected string $layout = "admin";

    public function index(): string
    {
        $title = "Admin panel";
    
        $content = $this->view()->render(view: 'admin/index', context: compact(var_name: 'title'));
        return $content;
        
    } 
}
