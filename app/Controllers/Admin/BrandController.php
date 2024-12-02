<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Models\Brand;
use Core\Http\Request;

class BrandController extends BaseController
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Brand();
        $this->request = $request;
    }

    public function index(): string
    {
        $title = "All brands";
        $brands = $this->model->selectAll();
        return $this->view()->render(view: 'admin/brands/index', context: compact('title',  'brands'));
    } 

    public function create()
    {
        $title = "New brand";
        return $this->view()->render(view: 'admin/brands/create', context: compact(var_name: 'title'));
    }


    /**
     * Store a new user in the database.
     */
    public function store()
    {
        $this->model->insert(['name' => $this->request->get('name'), 'description' => $this->request->get('description')]);
        return $this->redirect('/admin/brands');
    }

    public function edit($param)
    {
        extract($param);
        $title = "Edit brand";
        $brand = $this->model->get($id);
        return $this->view()->render(view: 'admin/brands/edit', context: compact( 'title', 'brand'));
    }

    public function update()
    {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name'), 'description' => $this->request->get('description')]);

        $this->redirect('/admin/brands');
    }

    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/brands');
    }

}
