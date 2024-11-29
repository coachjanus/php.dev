<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\{User,  Role};
use Core\{Session};
class Dashboard extends BaseController 
{
    protected string $layout = "admin";
    protected $model;
    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new User();
        $this->request = $request;
        
        $userId = Session::getInstance()->get("userId");
        if ($userId) {
            $this->model = $this->getUser($userId);
            if (!$this->isGranted("admin")) {
                $this->redirect("/profile");
            }
        } else {
            $this->redirect("/login");
        }

        // $this->isAuth = $this->isLogged();

    }
    protected function role()
    {
        if ($this->model) {
            $role = (new Role())->get($this->model->role_id);
            return $role->name;
        }

    }
    
    protected function isGranted(string $name)
    {
        return ($this->role() == $name) ?? false;
    }
    protected function getUser(string $userId)
    {
        return $this->model->findBy("id='{$userId}'");
    }
    public function index()
    {
        $title = "Welcome to Admin Dashboard!";
        // var_dump($title);
        $content = $this->view()->render("admin/index", compact("title"));
        return $content;
    }
}
