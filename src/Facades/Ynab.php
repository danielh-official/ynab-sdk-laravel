<?php

namespace DanielHaven\YnabSdkLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DanielHaven\YnabSdkLaravel\Ynab
 *
 * @codeCoverageIgnore
 */
class Ynab extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \DanielHaven\YnabSdkLaravel\Ynab::class;
    }
}
