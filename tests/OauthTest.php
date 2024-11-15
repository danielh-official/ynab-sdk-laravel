<?php

use DanielHaven\YnabSdkLaravel\Oauth;

it('gets the auth url', function () {
    $query = http_build_query([
        'client_id' => config('ynab-sdk-laravel.client.id'),
        'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
        'response_type' => config('ynab-sdk-laravel.response_type'),
    ]);

    expect((new Oauth)->getAuthUrl())->toBe("https://app.ynab.com/oauth/authorize?$query");
});
