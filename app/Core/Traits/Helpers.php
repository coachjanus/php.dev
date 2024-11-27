<?php

namespace Core\Traits;

trait Helpers
{
    public static function getHash($parameter)
    {
        $hash = password_hash($parameter, PASSWORD_DEFAULT);
        return $hash;
    }
}