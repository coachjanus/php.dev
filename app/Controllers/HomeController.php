<?php declare(strict_types=1);

namespace Controllers;

use Core\Http\{BaseController, Request};
use Models\{Product};

class HomeController extends BaseController
{
    protected string $layout = "app";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Product();
        $this->request = $request;
    }

    public function index(): string
    {
        $title = "Home page";
        return $this->view()->render(view: 'index', context: compact(var_name: 'title'));
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
        
        echo json_encode($products);
        // return $products;
    }
}
