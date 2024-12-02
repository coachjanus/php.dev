<?php

return [
    'db' => [
        'driver' => 'mysql',
        'dbname' => getenv('DB_NAME'),
        'host'    => getenv('DB_HOST'),
        'charset' => 'utf8mb4',
        'port' => 3306,
    ],
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'options' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
];  

// 'connection' => 'mysql:host='.getenv('DB_HOST'),

// return [
//     'database' => [
//         'name'       => getenv('DB_NAME'),
//         'username'   => getenv('DB_USERNAME'),
//         'password'   => getenv('DB_PASSWORD'),
//         'connection' => 'mysql:host='.getenv('DB_HOST'),
//         'options'    => [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//             PDO::ATTR_EMULATE_PREPARES   => false,
//         ],
//     ],
// ];

