<?php
declare(strict_types=1);

namespace Controllers;

use Core\Http\BaseController;
use Core\Database\Connection;
// app/Controllers/ContactController.php
// require_once dirname(__DIR__, 2).'/app/Core/Http/Response.php';
// require_once dirname(__DIR__, 2).'/app/Core/Http/BaseController.php';
// require_once dirname(__DIR__, 2).'/app/Core/Database/Connection.php';

class ContactController extends BaseController
{
    // protected Response $response;
    
    public function __construct()
    {
    }

    public function index()
    {
        $title = "Contact page";

        $config = require_once dirname(__DIR__, 2).'/config/db.php';
        $pdo = Connection::make($config['database']);

        $sql = "SELECT * FROM feedback";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        // var_export($result);

        $content = render('contact', compact('title', 'result'));
        return $content;
        // $this->response = new Response($content);
        // $this->render($content);       
    } 

    public function show($params) {
        $title = "Contact item";
        extract($params);
        var_dump($id);
        var_export($id);

        $config = require_once dirname(__DIR__, 2).'/config/db.php';
        $pdo = Connection::make($config['database']);

        $sql = "SELECT * FROM feedback WHERE id=?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$id]);
        $result = $statement->fetch();
        // var_export($result);

        $content = render('show', compact('title', 'result'));
        return $content;
    }
}
