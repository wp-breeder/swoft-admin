<?php
return [
    'name'  => 'auth-center',
    'debug' => env('SWOFT_DEBUG', 1),

    'auth' => [
        'jwt' => [
            'algorithm' => 'HS256',
            'secret' => '1231231'
        ],
    ],
];
