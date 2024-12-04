<?php
// 
declare(strict_types=1);

namespace Core\Http;


class Response
{
    public function __construct(
        private string $body = '',
        private Status $status = Status::OK,
        private array $headers = [],
        // ?View $view = null,
    ) {

        $this->status = $status;
        $this->body = $body;
        // $this->view = $view;

        foreach ($headers as $key => $values) {
            if (! is_array($values)) {
                $values = [$values];
            }

            foreach ($values as $value) {
                $this->addHeader($key, $value);
            }
        }
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?Header
    {
        return $this->headers[$name] ?? null;
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

    public function getBody(): string|array|null
    {
        return $this->body;
    }

    public function setContentType(ContentType $contentType): self
    {
        $this
            ->removeHeader(ContentType::HEADER)
            ->addHeader(ContentType::HEADER, $contentType->value);
        return $this;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;
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

    private function sendHeaders(): void
    {
        if (headers_sent()) {
            return;
        }

        foreach ($this->resolveHeaders() as $header) {
            header($header);
        }

        http_response_code($this->getStatus()->value);
    }

    private function resolveHeaders()
    {
        $headers = $this->getHeaders();

        if (is_array($this->getBody())) {
            $headers[ContentType::HEADER] ??= new Header(ContentType::HEADER);
            $headers[ContentType::HEADER]->add(ContentType::JSON->value);
        }

        foreach ($headers as $key => $header) {
            foreach ($header->values as $value) {
                yield "{$key}: {$value}";
            }
        }
    }

    private function sendContent(): void
    {
        foreach ($this->resolveBody() as $content) {
            echo $content;
            ob_flush();
        }
    }

    private function resolveBody()
    {
        $body = $this->getBody();
        // if ($body instanceof Generator) {
        // return $body;
        // }

        if (is_array($body)) {
            yield json_encode($body);
        } elseif ($body instanceof View) {
            yield $this->viewRenderer->render($body);
        } else {
            yield $body;
        }
    }

    public static function redirect($location)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].$location);
        exit();
    }

    public static function back()
    {
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit();
    }

}

