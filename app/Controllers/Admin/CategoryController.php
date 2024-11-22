<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\{Section, Category};

class CategoryController extends BaseController 
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Category();
        $this->request = $request;  
    }
   
    public function index()
    {
        $title = "All categories";
        $categories = $this->model->all();
        return $this->view()->render("admin/categories/index", compact("title", "categories"));
    }

    public function create()
    {
        $title = "New category";

        $sections = (new Section())->all();
        return $this->view()->render("admin/categories/create", compact("title", "sections"));
        
    }
    //  url?id=1 url/1 url/slug
    public function edit($parameters)
    {
        extract($parameters);
        $title = "Edit category";
        $category = $this->model->get($id);
        return $this->view()->render("admin/categories/edit", compact("title", "category"));
    }
    public function store()
    {
        var_dump($this->request);
        $cover = $this->request->get('cover');

        var_export($cover['tmp_name']);

        exit;
         $this->model->insert([
            'name' => $this->request->get(key: 'name'),
            'section_id' => $this->request->get(key: 'section_id'),
            'cover' => $this->request->get(key: 'cover'),
        ]);
        return $this->redirect('/admin/categories');

    }

    public function update() {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name')]);
        return $this->redirect('/admin/categories');
    }


    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/categories');
    }

}
