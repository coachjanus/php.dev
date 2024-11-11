<?php
declare(strict_types=1);
namespace Core\Http;
final class Header
{
    public function __construct(
        public string $name,
        public array $values = [],
    ) {
    }
    
    public function add(mixed $value): void
    {
        $this->values[] = $value;
    }

}