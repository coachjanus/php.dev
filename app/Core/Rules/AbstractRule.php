<?php

namespace Core\Rules;

abstract class AbstractRule
{
    protected $isError = false;

    public function hasError()
    {
        return $this->isError;
    }

    public function errorFound()
    {
        $this->isError = true;
    }

    abstract function getError();
}