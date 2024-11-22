<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\Section;

class SectionController extends BaseController 
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Section();
        $this->request = $request;  
    }
   
    public function index()
    {
        $title = "All sections";
        $sections = $this->model->selectAll();
        return $this->view()->render("admin/sections/index", compact("title", "sections"));
    }

    public function create()
    {
        $title = "New section";
        return $this->view()->render("admin/sections/create", compact("title"));
        return $this->redirect('/admin/sections');
    }
    //  url?id=1 url/1 url/slug
    public function edit($parameters)
    {
        extract($parameters);
        $title = "Edit section";
        $section = $this->model->get($id);
        return $this->view()->render("admin/sections/edit", compact("title", "section"));
    }
    public function store()
    {
        

         $this->model->insert([
            'name' => $this->request->get(key: 'name')
        ]);
        // return $this->redirect('/admin/sections');

    }

    public function update() {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name')]);
        return $this->redirect('/admin/sections');
    }


    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/sections');
    }

}
