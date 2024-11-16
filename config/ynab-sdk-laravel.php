<?php

// config for DanielHaven/YnabSdkLaravel
return [
    'base_url' => 'https://api.ynab.com/v1',
    'client' => [
        'id' => env('YNAB_SDK_LARAVEL_CLIENT_ID'),
        'secret' => env('YNAB_SDK_LARAVEL_CLIENT_SECRET'),
    ],
    'redirect_uri' => env('YNAB_SDK_LARAVEL_REDIRECT_URI', 'http://localhost'),
    'response_type' => env('YNAB_SDK_LARAVEL_RESPONSE_TYPE', 'code'),
];
