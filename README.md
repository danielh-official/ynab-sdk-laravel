# YNAB SDK for Laravel

> [!NOTE]
> This project is still a work-in-progress. Install at your own risk!

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danielh-official/ynab-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/danielh-official/ynab-sdk-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/danielh-official/ynab-sdk-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/danielh-official/ynab-sdk-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/danielh-official/ynab-sdk-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/danielh-official/ynab-sdk-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/danielh-official/ynab-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/danielh-official/ynab-sdk-laravel)

## Introduction

The YNAB SDK for Laravel provides an expressive interface for interacting with YNAB's API within a Laravel application.

## Installation

You can install the package via composer:

```bash
composer require danielh-official/ynab-sdk-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ynab-sdk-laravel-config"
```

This is the contents of the published config file:

```php
return [
    'base_url' => 'https://api.ynab.com/v1',
    'client' => [
        'id' => env('YNAB_SDK_LARAVEL_CLIENT_ID'),
        'secret' => env('YNAB_SDK_LARAVEL_CLIENT_SECRET'),
    ],
    'redirect_uri' => env('YNAB_SDK_LARAVEL_REDIRECT_URI', 'http://localhost'),
    'response_type' => env('YNAB_SDK_LARAVEL_RESPONSE_TYPE', 'code'),
];
```
## Usage

### Personal Access Tokens

You can enter a personal access token directly (see: https://api.ynab.com/#personal-access-tokens).

```php
use DanielHaven\YnabSdkLaravel\Ynab;

$ynab = new Ynab('insert-access-token-here');
```

This class exposes 9 resource methods for accessing YNAB's API (see: https://api.ynab.com/v1).

* `$ynab->user()`
* `$ynab->budgets()`
* `$ynab->accounts()`
* `$ynab->categories()`
* `$ynab->payees()`
* `$ynab->payeeLocations()`
* `$ynab->months()`
* `$ynab->transactions()`
* `$ynab->scheduledTransactions()`

Each method within its resource aligns with an endpoint:

```php
<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Resources;

final class User extends Resource
{
    /**
     * @link https://api.ynab.com/v1#/User/getUser
     */
    public function get()
    {
        return $this->client->get('/user');
    }
}
```
### Oauth

Oauth authentication must be used for applications that accept access tokens from other users (see: https://api.ynab.com/#oauth-applications).

#### Auth Url

The Auth Url can be retrieved with the `OauthHelper` class.

```php
use DanielHaven\YnabSdkLaravel\OauthHelper;

OauthHelper::getAuthUrl();
```

The auth url uses the following configuration parameters:

```php
[
    'client_id' => config('ynab-sdk-laravel.client.id'),
    'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
    'response_type' => config('ynab-sdk-laravel.response_type'),
]
```

With the following parameters:

* `client_id=123`
* `redirect_uri=https://my-app.com/ynab-oauth/callback`
* `response_type=code`

The auth url should be the following: https://app.ynab.com/oauth/authorize?client_id=123&redirect_uri=https%3A%2F%2Fmy-app.com%2Fynab-oauth%2Fcallback&response_type=code

When you click on the link, you should be sent to a YNAB page asking you to authorize.

The route used in the `redirect_uri` should be equal to the Callback Route you register via the package.

#### Callback Route

##### Registring the Route

A configurable route macro is registered by the package.

Place `Route::ynabSdkLaravelOauth();` in your routes file to instantiate it. By default, the url should look like this: `https://your-site.com/ynab-oauth/callback`.

You can configure the `$baseUrl` and `$baseName` like so: `Route::ynabSdkLaravelOauth('my-ynab-oauth', 'my-ynab-oauth');`. The route should then look like this: `https://your-site.com/my-ynab-oauth/callback`.

The second argument is for the name, such that you can access the route using something like `redirect()->route('my-ynab-oauth')`.

##### Accessing the Controller

The controller builds the route that is used to authenticate with YNAB. Here are the components:

```php
$query = [
    'client_id' => config('ynab-sdk-laravel.client.id'),
    'client_secret' => config('ynab-sdk-laravel.client.secret'),
    'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
    'grant_type' => $request->query('grant_type', 'authorization_code'),
    'code' => $request->query('code'),
];

if ($request->boolean('use_readonly_scope')) {
    $query['scope'] = 'read-only';
}

if ($request->string('state')) {
    $query['state'] = $request->string('state');
}

```

Other than the config variables, everything else can be left as is.

Let's reuse the aformentioned parameters:

* `client_id=123`
* `redirect_uri=https://my-app.com/ynab-oauth/callback`
* `response_type=code`

And add that the `client_secret=456` and the `code=8u32433` (this is retrieved from accessing the auth url and authorizing on the YNAB page).

The url the controller uses to authenticate with YNAB should look like the following: https://app.ynab.com/oauth/token?client_id=123&client_secret=456&redirect_uri=https%3A%2F%2Fmy-app.com%2Fynab-oauth%2Fcallback&grant_type=authorization_code&code=8u32433

If the request is successful, two events should be thrown.

* `RefreshTokenRetrieved` (accepts the `refresh_token` and exposes a `$dateRetrieved` variable to use in conjunction with the `expires_in` value; if missing, the event is not dispatched)
* `AccessTokenRetrieved` (accepts the `access_token` and `expires_in`, if missing the `access_token`, the event is not dispatched)

Create a listener for the events to interact with the data.

> [!IMPORTANT]
> Also, the controller accepts a `redirect_to` parameter, which is `home` by default. If you do not register a route that is named "home" in your app, the controller will fail with a 500 error.

Once you have the `access_token`, you can access the API the way you would with a personal access token:

```php
use DanielHaven\YnabSdkLaravel\Ynab;

$ynab = new Ynab('insert-access-token-here');
```

Be wary that your `access_token` has an expiration date (i.e., `expires_in`). You may track when your token is expiring and then use `refresh_token` to reset your `access_token` without the user having to authenticate on YNAB again.

- [ ] Build controller for refreshing access token

## Running Tests

To run tests, run the following command:

```bash
composer test
```

You may run tests with coverage:

```bash
composer test-coverage
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Daniel Haven](https://github.com/danielh-official)
- [All Contributors](../../contributors)
- 
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
