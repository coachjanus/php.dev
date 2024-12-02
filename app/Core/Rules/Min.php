<?php

namespace Core\Rules;

class Min  extends AbstractRule implements Checkable
{
    protected $min;

    public function __construct($min)
    {
        $this->min = $min;
    }


    public function isValid($value=null)
    {
        if(strlen($value) >= $this->min) {
            return true;
        }

        $this->errorFound();
        return false;
    }

    public function getError()
    {
        return "Value must be greater than {$this->min}";
    }
}