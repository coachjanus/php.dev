<?php

namespace App\Models;

use Core\App;
use Core\Database\QueryBuilder;

abstract class Model extends QueryBuilder
{
    /**
     * Model constructor.
     *
     * @throws \ReflectionException
     */
    public function __construct()
    {
        parent::__construct(App::get('database'));
    }
}
