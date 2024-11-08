<?php
declare(strict_types=1);

require_once dirname(__DIR__,2)."/app/Core/Response.php";
require_once dirname(__DIR__,2)."/app/Core/Database/Connection.php";

class ContactController
{
    protected Response $response;
    public function __construct()
    {
        // echo "Hello Controller";
    }

    public function index()
    {

        $title = "Welcome to Contact Page!";


        $config = require_once dirname(__DIR__,2)."/config/db.php";

        $pdo = Connection::make($config['database']);

        $sql = 'SELECT * FROM feedback';

        $statement = $pdo->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        var_export($result);
        $content = render("contact", compact("title"));
        $this->response = new Response($content);
        $this->response->send();
    }
}
