<?php
declare(strict_types=1);

require_once dirname(__DIR__,2)."/app/Core/Response.php";

class HomeController
{
    protected Response $response;
    public function __construct()
    {
        // echo "Hello Controller";
    }

    public function index()
    {
        $title = "Welcome to Home Page!";
        $content = render("index", compact("title"));
        $this->response = new Response($content);
        $this->response->send();
    }
}
