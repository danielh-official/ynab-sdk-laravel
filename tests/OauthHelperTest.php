<?php

use DanielHaven\YnabSdkLaravel\OauthHelper;
use Illuminate\Support\Carbon;

it('gets the auth url', function () {
    expect((new OauthHelper)->getAuthUrl())->toBe('https://app.ynab.com/oauth/authorize?redirect_uri=http%253A%252F%252Flocalhost%252Fynab-oauth%252Fcallback&response_type=code');
});

it('gets the expiration date', function () {
    Carbon::setTestNow(Carbon::parse('2021-01-01 00:00:00'));

    $result = (new OauthHelper)->getExpirationTimeOfAccessToken(Carbon::now(), 3600);

    expect($result)->toBeInstanceOf(Carbon::class)->and($result->toDateTimeString())->toBe('2021-01-01 01:00:00');
});
