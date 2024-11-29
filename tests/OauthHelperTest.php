<?php

use DanielHaven\YnabSdkLaravel\OauthHelper;
use Illuminate\Support\Carbon;

it('gets the auth url', function () {
    $query = http_build_query([
        'client_id' => config('ynab-sdk-laravel.client.id'),
        'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
        'response_type' => config('ynab-sdk-laravel.response_type'),
    ]);

    expect((new OauthHelper)->getAuthUrl())->toBe("https://app.ynab.com/oauth/authorize?$query");
});

it('gets the expiration date', function () {
    Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));

    $result = (new OauthHelper)->getExpirationTimeOfAccessToken(Carbon::now(), 3600);

    expect($result)->toBeInstanceOf(Carbon::class)->and($result->toDateTimeString())->toBe('2021-01-01 01:00:00');
});
