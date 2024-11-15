<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\Brand;

class BrandController extends BaseController 
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Brand();
        // var_dump($request);
        $this->request = $request;  
    }
   
    public function index()
    {
        $title = "All brands";
        $brands = $this->model->selectAll();
        return $this->view()->render("admin/brands/index", compact("title", "brands"));
    }

    public function create()
    {
        $title = "New brand";
        return $this->view()->render("admin/brands/create", compact("title"));
    }
    public function store()
    {
        var_dump([
            'name' => $this->request->get(key: 'name'), 
            'description' => $this->request->get('description'), 
        ]);

         $this->model->insert([
            'name' => $this->request->get(key: 'name'), 
            'description' => $this->request->get('description'), 
        ]);
        // return $this->redirect('/admin/brands');

    }
}
