<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\Role;

class RoleController extends BaseController 
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Role();
        $this->request = $request;  
    }
   
    public function index()
    {
        $title = "All roles";
        $roles = $this->model->selectAll();
        return $this->view()->render("admin/roles/index", compact("title", "roles"));
    }

    public function create()
    {
        $title = "New roles";
        return $this->view()->render("admin/roles/create", compact("title"));
        return $this->redirect('/admin/roles');
    }

    public function edit($parameters)
    {
        extract($parameters);
        $title = "Edit roles";
        $role = $this->model->get($id);
        return $this->view()->render("admin/roles/edit", compact("title", "role"));
    }
    public function store()
    {
         $this->model->insert([
            'name' => $this->request->get(key: 'name')
        ]);
        $this->redirect('/admin/roles');

    }

    public function update() {
        $this->model->update(['id' => $this->request->get('id'), 'name' => $this->request->get('name')]);
        return $this->redirect('/admin/roles');
    }


    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/roles');
    }

}
