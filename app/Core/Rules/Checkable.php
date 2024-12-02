<?php

namespace Core\Rules;

interface Checkable
{
    public function isValid($value=null);
}