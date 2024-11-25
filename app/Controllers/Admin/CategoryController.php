<?php declare(strict_types=1);

namespace Controllers\Admin;

use Core\Http\BaseController;
use Core\Http\Request;
use Models\{Section, Category};
use Core\Traits\Upload;

class CategoryController extends BaseController 
{
    use Upload;
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

    public function edit($parameters)
    {
        extract($parameters);
        $title = "Edit category";
        $category = $this->model->get($id);
        $sections = (new Section())->all();
        return $this->view()->render("admin/categories/edit", compact("title", "category", 'sections'));
    }
    public function store()
    {
        // var_dump($this->request);
        $cover = $this->request->get('cover');


        // var_export($cover);

        // exit;
        $cover = $this->upload($cover, 'storage/categories');

         $this->model->insert([
            'name' => $this->request->get(key: 'name'),
            'section_id' => $this->request->get(key: 'section_id'),
            'cover' => $cover,
        ]);
        $this->redirect('/admin/categories');

    }

    public function update() {

        if(!$this->request->get('cover')){
            $cover = $this->request->get('_cover');
        }else{
            $cover = $this->request->get('cover');
            $cover = $this->upload($cover, 'storage/categories');

            $segment = explode('/', $this->request->get('_cover'));
            $filename = array_pop($segment);

            $path = dirname(__DIR__, 2).DIRECTORY_SEPARATOR."public/storage/categories/".$filename;
            unlink($path);

        }

        $this->model->update(parameters: [
            'id' => $this->request->get('id'),
            'name' => $this->request->get(key: 'name'),
            'section_id' => $this->request->get(key: 'section_id'),
            'cover' => $cover,
        ]);
        $this->redirect('/admin/categories');

    }


    public function destroy($params)
    {
        extract($params);
        $this->model->delete($id);
        return $this->redirect('/admin/categories');
    }

}
