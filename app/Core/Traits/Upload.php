<?php

namespace Core\Traits;

trait Upload
{

    
    protected $file = [];
    protected $file_size;
    protected $file_type;
    protected $file_name;
    protected $file_ext;
    protected $tmp_name;
    protected $destination;
    protected $default_permission = 0750;
    public $root;
    public function upload($file, $destination)
    {
        $this->file = $file;
        // var_export($file);
        $this->root = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR;
        // var_export($this->root);
        $this->tmp_name = $this->file['tmp_name'];
        
        if(!$this->set_destination($destination)){
            throw new \Exception('Upload: Can\' create destination. '. $this->root.$this->destination);
        }
        return $this->save_file();
    }
    public function save_file()
    {
        if(empty($this->file_name)){
            $this->create_new_file_name();
        }

        $this->file['file_name'] = $this->file_name;
        $this->file['full_path'] = $this->root.$this->destination.$this->file_name;
        $this->file['path'] = $this->destination.$this->file_name;

        if(move_uploaded_file($this->tmp_name, $this->file['full_path'])){
            return "http://{$_SERVER['HTTP_HOST']}/{$this->file['path']}";
        }else{
            throw new \Exception("Upload: Cant upload file.");
        }


    }
    public function create_new_file_name()
    {
        $file_name = sha1(uniqid(mt_rand(1, 9999), true).$this->destination).time();
        $this->set_file_name($file_name);
    }
    public function set_file_name($file_name)
    {
        $this->file_name = $file_name;
    }

    public function set_destination($destination)
    {
        $this->destination = $destination . DIRECTORY_SEPARATOR;
        return $this->destination_exist() ? TRUE: $this->create_destination();
    }

    protected function create_destination()
    {
        return mkdir($this->root . $this->destination, $this->default_permission, TRUE);

    }

    protected function destination_exist()
    {
        return is_writeable($this->root . $this->destination);
    }


}