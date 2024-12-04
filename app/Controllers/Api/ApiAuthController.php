<?php declare(strict_types=1);

namespace Controllers\Api;

use Core\Http\{Request, JsonResponse};
use Models\{User};
use Core\{Session};

class ApiAuthController
{

    public function __construct(private Request $request)
    {
        $this->request = $request;
    }

    public function auth()
    {
        $userId = Session::instance()->get('userId');
        if($userId) {           
            return new JsonResponse(['id'=>$userId]);
        } else {
            return false;
        } 
    }
}

    