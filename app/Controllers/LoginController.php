<?php declare(strict_types=1);

namespace Controllers;
use Core\Http\BaseController;
use Core\Http\Request;
use Core\Session;
use Models\User;
use Core\Traits\Helpers;

class LoginController extends BaseController 
{
    use Helpers;
    protected string $layout = "auth";
    protected $model;
    public $isAuth = false;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new User();
        $this->request = $request;

        $this->isAuth = $this->isLogged();

    }

    public function isLogged(): bool
    {
        if (Session::getInstance()->get("userId")) {
            return true;
        }
        return false;
    }
   
    public function login()
    {
        $title = "Sign in";
        if ($this->isAuth) {
            $this->redirect("/profile");
        } else {
            return $this->view()->render("auth/login", compact("title"));
        }
    }
    private function checkEmail(string $email): bool
    {
        return $this->model->findBy("email='$email'") ? true : false;  
    }

    protected function getUser(string $email)
    {
        return $this->model->findBy("email='{$email}'");
    }

    public function signin() {

        $user = $this->getUser($this->request->get("email"));
        
        if ($user) {
            if(password_verify($this->request->get("password"), $user->password)) {
                $this->isAuth = true;
                Session::getInstance()->set('userId', $user->id);
            }
        } else {
            $this->redirect("/login");
        }
        $this->redirect("/profile");
    }

    public function logout() {
        $this->isAuth = false;
        Session::getInstance()->remove("userId");
        $this->redirect("/");
    }
}
