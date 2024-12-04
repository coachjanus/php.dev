<?php declare(strict_types=1);

namespace Controllers\Api;

use Core\Http\{Request, JsonResponse};
use Models\{Product, Order};
use Core\{Session};

class ApiCheckout
{
    protected $model;

    public function __construct(private Request $request)
    {
        $this->model = new Order();
        $this->request = $request;
    }

    public function checkout()
    {
        // if (!$this->user) {
        //     $this->redirect('/login');
        // }

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

           
            $options = [
                'error' => false,
                'message' => "Everything OK",
                'result' => $result
            ];
            // return new JsonResponse($options);
            echo json_encode($options);
        // } catch(\Exception $e) {
        //     $options = [
        //         'error' => true,
        //         'message' => $e->getMessage(),
        //         'result' => $result
        //     ];
        //     echo json_encode($options);
        // }

        // return new JsonResponse(['id'=>$userId]);
        // $response = new Response("Everything OK");
        // return $response;

        // header('Location: http://'.$_SERVER['HTTP_HOST']);
        // exit();

    }


    
}
