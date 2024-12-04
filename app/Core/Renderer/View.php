<?php declare(strict_types=1);

namespace Core\Renderer;

// use Layout;
final class View
{
    
    /**
     * Template constructor.
     * @param string $path
     * @param string $layout
     * @param array $parameters
     */
    public function __construct(private string $path, protected string $layout, private array $parameters = [])
    {
        $this->path = rtrim(string: $path, characters: '/').'/';
        $this->layout =  $layout;
        $this->parameters = $parameters;
    }
  
    /**
     * @param string $view
     * @param array $context
     * @return string
     * @throws \Exception
     */
    public function render(string $view, array $context = []): string
    {
        ob_start(null, 2048);
        
        $layoutInstance = Layout::getInstance(path: $this->path, layout: $this->layout);
        
        $content = $this->load(view: $view, context: $context);
        
        return str_replace(search: "{{ content }}", replace: $content, subject: ob_get_clean());
    }

    private function load(string $view, array $context) : string
    {
        if (!file_exists(filename: $file = $this->path.$view.".php")) {
            throw new \Exception(message: sprintf(format: 'The file %s could not be found.', values: $file));
        }

        ob_start();
        extract(array: $context);
        include ($file);
        return ob_get_clean();
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->parameters[$key] ?? null;
    }
}