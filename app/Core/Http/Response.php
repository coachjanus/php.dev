<?php
declare(strict_types=1);

namespace Core\Http;

// require_once "Status.php";
class Response
{
    // private string $body;
    // private string $status;
    // private array $headers=[];
    public function __construct(
        private string $body,
        private Status $status = Status::OK,
        private array $headers=[]
    )
    {
        $this->status = $status;
        $this->body = $body;

        foreach ($headers as $key => $values) {
            if(!is_array($values)) {
                $values = [$values];
            }
            foreach ($values as $value) {
                $this->addHeader($key, $value);
            }
        }
    }
    
    public function addHeader(string $key, string $value): self 
    {
        $this->headers[$key] ??= new Header($key);
        $this->headers[$key]->add($value);
        return $this;
    }

    public function removeHeader(string $key): self
    {
        unset($this->headers[$key]);
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHeader($name)
    {
        return $this->headers[$name] ?? null;
    }

    public function setStatus(Status $status):self
    {
        $this->status = $status;
        return $this;
    }

    public function setContentType(ContentType $contentType):self
    {
        $this
            ->removeHeader(ContentType::HEADER)->addHeader(ContentType::HEADER, $contentType->value);
        return $this;
    }

    public function send()
    {
        ob_start();
        $this->sendHeaders();
        ob_flush();
        $this->sendContent();
        return ob_end_flush();
    }

    public function sendHeaders()
    {
        if (headers_sent()) return;

        foreach ($this->resolveHeaders() as $header) {
            header($header);
        }
        http_response_code($this->getStatus()->value);
    }

    public function resolveHeaders() 
    {
        $headers =$this->getHeaders();

        foreach($headers as $key => $header) {
            foreach($header->values as $value) {
                yield "{$key}: {$value}";
            }
        }
    }

    private function sendContent()
    {
        foreach($this->resolveBody() as $content) {
            echo $content;
            ob_flush();
        }

    }
    private function resolveBody()
    {
        $body = $this->getBody();

        if (is_array(($body))) {
            yield json_encode($body);
        } else {
            yield $body;
        }
    }
}