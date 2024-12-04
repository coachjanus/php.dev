<?php
namespace Controllers;

use Core\Http\{BaseController, Request,Response};
// use Core\Interfaces\AuthInterface;
use Core\{Session};
use Models\{User, Order};

class CartController extends BaseController //implements AuthInterface
{
    protected string $layout = 'app';    
    protected $model;
    protected $user;
    protected $userId;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Order();
        

        $this->userId = Session::instance()->get('userId');
     

        if($this->userId) {
            $this->user = (new User())->get($this->userId);
        } 

        $this->isGranted();
    }

    public function isGranted(string $name = 'customer'):bool
    {
        if (!$this->user) {
            $this->redirect('/login');
        }
        return true;
    }

    public function index()
    {

        $title = "Cart page";
        return new Response($this->view()->render(view: 'cart', context: compact(var_name: 'title')));
    }

    public function auth()
    {
        if($this->user) {
            echo json_encode($this->userId);
        } else {
            echo json_encode(false);
        } 
    }

    public function checkout()
    {
        $content = trim(file_get_contents("php://input"));

        // var_dump($content);
        // exit;
        $decoded = json_decode($content, true);
        if (!is_array($decoded)) {
            throw new \Exception("Failed to decode json object!");
        }

        $productsInCart = json_encode($decoded['cart']);

        // try {
            $userId = Session::instance()->get('userId');

            $result = $this->model->insert([
                'user_id' => $userId, 
                'products' => $productsInCart, 
            ]);
            
        $this->redirect('/cart');
    }
}