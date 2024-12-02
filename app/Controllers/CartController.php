<?php
namespace Controllers;

use Core\Http\{BaseController, Request};
// use Core\Interfaces\AuthInterface;
use Core\{Session};
use Models\{User, Order};

class CartController extends BaseController //implements AuthInterface
{
    protected string $layout = 'app';    

    protected $model;
    protected Order $order;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new User();
        $this->request = $request;
        $userId = Session::instance()->get('userId');
        // if($userId) {
        //     $this->model = (new User)->first($userId);
        // } 

        // $this->isGranted();
        // $this->order = new Order();
    }


    // public function __construct(private Request $request){
    //     $this->request = $request;
    //     parent::__construct();
    //     $userId = Session::instance()->get('userId');

    //     if($userId) {
    //         $this->user = (new User)->first($userId);
    //     } 

    //     $this->isGranted();
    //     $this->order = new Order();
    // }


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
        return $this->view()->render(view: 'cart', context: compact(var_name: 'title'));
    }

    public function auth()
    {
        if($this->user) {
            echo json_encode($this->user->id);
        } else {
            echo json_encode(false);
        } 
    }

    public function checkout()
    {
        if (!$this->user) {
            $this->redirect('/login');
        }

        if (!$this->request->isMethodPost()) {
            throw new \Exception("Only POST requests are allowed!");
        }

        if (!$this->request->isJson()) {
            throw new \Exception("Content-Type must be application/json!");
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        if (!is_array($decoded)) {
            throw new \Exception("Failed to decode json object!");
        }

        $productsInCart = json_encode($decoded['cart']);

        $this->order->user_id = $this->user->id;
        $this->order->products = $productsInCart;

        try {
            $sql = "INSERT INTO orders (user_id, products) VALUES (?, ?)";
            $result = $this->order->insert($sql, [$this->user->id, $productsInCart]);

            $options = [
                'error' => false,
                'message' => "Everything OK",
                'result' => $result
            ];
            echo json_encode($options);
        } catch(\Exception $e) {
            $options = [
                'error' => true,
                'message' => $e->getMessage(),
                'result' => $result
            ];
            echo json_encode($options);
        }


    }
}