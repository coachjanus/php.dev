<?php declare(strict_types=1);

namespace Controllers;
use Core\Http\BaseController;
use Core\Http\Request;
use Models\User;
use Core\Traits\Helpers;
class RegisterController extends BaseController 
{
    use Helpers;
    protected string $layout = "auth";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new User();
        $this->request = $request;

    }
   
    public function index()
    {
        $title = "Sign on";
        $content = $this->view()->render("auth/index", compact("title"));
        return $content;
    }
    private function checkEmail(string $email): bool
    {
        return $this->model->findBy("email='$email'") ? true : false;  
    }

    public function register() {
        if ($this->checkEmail($this->request->get("email"))) {
            $this->redirect("/login");
        }

        $username = explode("@", $this->request->get("email"));
        $password = $this->getHash($this->request->get('password'));

        $this->model->insert([
            'email'=> $this->request->get("email"),
            'name'=> $username[0],
            'password'=> $password,
            'status' => 1,
            'role_id' => 2,
        ]);

        $this->redirect("/login");
    }
}
