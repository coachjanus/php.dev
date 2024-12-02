<?php

namespace Core\Rules;

class Required extends AbstractRule implements Checkable
{

    public function getError()
    {
        return "Value required ";
    }

    public function isValid($value=null)
    {
        if($value != null) {
            return true;
        }

        $this->errorFound();
        return false;
    }

}