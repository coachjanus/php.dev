<?php declare(strict_types=1);

namespace Controllers;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\User;
use Core\Session;

class ProfileController extends BaseController 
{

    protected string $layout = "app";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new User();
        $this->request = $request;
        $userId = Session::getInstance()->get("userId");

    }
   
    public function index()
    {
        $title = "Profile";
        
        return $this->view()->render("profile/index", compact("title"));

    }
    
}
