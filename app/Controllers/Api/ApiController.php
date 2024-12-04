<?php declare(strict_types=1);

namespace Controllers\Api;

use Core\Http\{Request, JsonResponse};
use Models\{Product};

class ApiController
{
    // protected string $layout = "app";
    protected $model;

    public function __construct(private Request $request)
    {
        $this->model = new Product();
        $this->request = $request;
    }


    public function getProducts()
    {
        $products = $this->model->columns([
            "products.*", 
            "categories.name as category", 
            "categories.id as categoryId", 
            "brands.name as brand", 
            "brands.id as brandId", 
            "badges.title"
        ])
        ->join([
            "categories"=>"category_id", "brands"=>"brand_id", 
            "badges"=>"badge_id"
        ])->getAll();

        $response = new JsonResponse($products);
        return $response;
    }
}
