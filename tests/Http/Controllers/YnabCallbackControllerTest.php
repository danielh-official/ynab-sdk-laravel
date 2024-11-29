<?php

use DanielHaven\YnabSdkLaravel\Events\AccessTokenRetrieved;
use DanielHaven\YnabSdkLaravel\Events\RefreshTokenRetrieved;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

it('gets an access token using authorization code grant flow', function () {
    Event::fake();

    Config::set('ynab-sdk-laravel.client.id', 'client-id');
    Config::set('ynab-sdk-laravel.client.secret', 'client-secret');
    Config::set('ynab-sdk-laravel.redirect_uri', 'redirect-uri');

    $route = 'https://app.ynab.com/oauth/token?client_id=client-id&client_secret=client-secret&redirect_uri=redirect-uri&grant_type=authorization_code&code=code&scope=read-only';

    Http::fake([
        $route => Http::response([
            'access_token' => 'access_token',
            'refresh_token' => 'refresh_token',
            'expires_in' => 10000,
        ]),
    ]);

    get(route('ynab-oauth.callback', [
        'code' => 'code',
        'use_readonly_scope' => true,
        'state' => 'state',
    ]))->assertRedirect(route('home'))->assertSessionHas('success', 'Access token retrieved');

    Event::assertDispatched(AccessTokenRetrieved::class, function (AccessTokenRetrieved $event) {
        return $event->accessToken === 'access_token' && $event->expiresIn === 10000;
    });

    Event::assertDispatched(RefreshTokenRetrieved::class, function (RefreshTokenRetrieved $event) {
        return $event->refreshToken === 'refresh_token' && $event->dateRetrieved->isToday();
    });
});

it('fails to get an access token using authorization code grant flow', function () {
    Event::fake();

    Config::set('ynab-sdk-laravel.client.id', 'client-id');
    Config::set('ynab-sdk-laravel.client.secret', 'client-secret');
    Config::set('ynab-sdk-laravel.redirect_uri', 'redirect-uri');

    $route = 'https://app.ynab.com/oauth/token?client_id=client-id&client_secret=client-secret&redirect_uri=redirect-uri&grant_type=authorization_code&code=code&scope=read-only';

    Http::fake([
        $route => Http::response([
            'access_token' => '',
        ]),
    ]);

    get(route('ynab-oauth.callback', [
        'code' => 'code',
        'use_readonly_scope' => true,
        'state' => 'state',
    ]))->assertRedirect(route('home'))->assertSessionHas('error', 'Failed to get access token');

    Event::assertNotDispatched(AccessTokenRetrieved::class);

    Event::assertNotDispatched(RefreshTokenRetrieved::class);
});
