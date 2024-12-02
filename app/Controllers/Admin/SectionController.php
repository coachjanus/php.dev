<?php
declare(strict_types=1);

namespace Controllers\Admin;
 
use Core\Http\{Request, BaseController};
use Models\Section;

class SectionController extends BaseController
{
   
    protected string $layout = "admin";
    protected $model;

    public function __construct(private Request $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->model = new Section();
    }

    public function index()
    {
        $sections = $this->model->selectAll();
        $title = "All sections";
        return $this->view()->render(view: 'admin/sections/index', context: compact('title',  'sections'));
    }
    
    public function create()
    {
        $title = "New section";
        return $this->view()->render(view: 'admin/sections/create', context: compact(var_name: 'title'));

        // return $this->render('admin/sections/create');
    }

    public function store()
    {
        $this->model->insert(['name' => $this->request->get('name')]);
        return $this->redirect('/admin/sections');
    }

    public function show($params)
    {
        extract($params);
    }

    public function edit($params)
    {
        extract($params);
        $section = $this->section->first($id);
        return $this->render('admin/sections/edit', ['section' => $section ]);
       
    }

    public function update1($params)
    {
        extract($params);
        $this->section->id = $id;
        $this->section->name = $this->request->name;
        $this->section->save();  
        $this->redirect('admin/sections');
    }

    public function update()
    {
        
        $this->section->id = $this->request->id;
        $this->section->name = $this->request->name;
        $this->section->save();  
    }


    public function destroy($params)
    {
        extract($params);
        $this->section->delete($id);
    }

}