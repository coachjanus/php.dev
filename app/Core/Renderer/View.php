<?php declare(strict_types=1);

namespace Core\Renderer;

final class View
{
    public function __construct(private string $path, protected string $layout, private array $parameters = [])
    {
        $this->path = rtrim(string: $path,characters: "/") ."/";
        $this->layout = $layout;
        $this->parameters = $parameters;
    }
    public function render(string $view, array $context = []): string
    {
        ob_start();
        $content = $this->template($view, $context);

        require_once "{$this->path}/layouts/{$this->layout}.php";
        return str_replace("{{ content }}", $content, ob_get_clean());
    }

    private function template($view, $context) {
        if(!file_exists($file = $this->path.$view.".php")) {
            throw new \Exception("The file could not be found.");
        }
        ob_start();
        extract($context);
        include($file); 
        return ob_get_clean();
    }

}
