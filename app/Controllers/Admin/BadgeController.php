<?php
declare(strict_types=1);

namespace Controllers\Admin;
 
use Core\Http\{Request, BaseController};
use Models\Badge;


class BadgeController extends BaseController
{
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->model = new Badge();
        $this->request = $request;
    }

    public function index()
    {
        $title = "All badges";
        $badges = $this->model->selectAll();
        return $this->view()->render(view: 'admin/badges/index', context: compact('title',  'badges'));
    }
    
    public function create()
    {
        $title = "New badge";
        return $this->view()->render(view: 'admin/badges/create', context: compact(var_name: 'title'));
    }

    public function store()
    {
        $this->model->insert(['title' => $this->request->get('title')]);
        $this->redirect('/admin/badges');   
    }

    public function show($params)
    {
        extract($params);
       
    }

    public function edit($params)
    {

        extract($params);
        $brand = $this->brand->first($id);
        return $this->render('admin/brands/edit', ['brand' => $brand ]);
       
    }

    public function update1($params)
    {
        extract($params);
        $this->brand->id = $id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        $this->brand->save();  
    }

    public function update()
    {
        
        $this->brand->id = $this->request->id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        $this->brand->save();  
    }


    public function destroy($params)
    {
        extract($params);
        $this->brand->delete($id);
    }

}