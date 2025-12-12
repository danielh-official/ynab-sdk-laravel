# YNAB SDK for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ynab-sdk-laravel/ynab-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/ynab-sdk-laravel/ynab-sdk-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ynab-sdk-laravel/ynab-sdk-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ynab-sdk-laravel/ynab-sdk-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ynab-sdk-laravel/ynab-sdk-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ynab-sdk-laravel/ynab-sdk-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ynab-sdk-laravel/ynab-sdk-laravel.svg?style=flat-square)](https://packagist.org/packages/ynab-sdk-laravel/ynab-sdk-laravel)

> [!IMPORTANT]
> If you use this package, please be sure to leave a star on the repository. It would help a lot!

## Introduction

The YNAB SDK for Laravel provides an expressive interface for interacting with YNAB's API within a Laravel application.

> [!TIP]
> For testing this package on a Laravel template, you can clone this repo: [ynab-sdk-laravel-template](https://github.com/danielh-official/ynab-sdk-laravel-template).

## Installation

You can install the package via composer:

```bash
composer require ynab-sdk-laravel/ynab-sdk-laravel
```

You can publish the following files with:

```bash
# config

php artisan vendor:publish --tag=ynab-sdk-laravel-config

# views

php artisan vendor:publish --tag=ynab-sdk-laravel-views

# migrations

php artisan vendor:publish --tag=ynab-sdk-laravel-migrations
```

## Usage

Read the [wiki](https://github.com/danielh-official/ynab-sdk-laravel/wiki) to learn more about how to use this package in your Laravel project.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Daniel Haven](https://github.com/danielh-official)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
