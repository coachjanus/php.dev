<?php

return [
    'database' => [
        'driver' => 'mysql',
        'dbname' => getenv('DB_NAME'),
        'host'=> getenv('DB_HOST'),
    ],
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
        
    'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]
];