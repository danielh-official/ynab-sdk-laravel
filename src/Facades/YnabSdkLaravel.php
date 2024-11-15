<?php

namespace DanielHaven\YnabSdkLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DanielHaven\YnabSdkLaravel\YnabSdkLaravel
 */
class YnabSdkLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \DanielHaven\YnabSdkLaravel\YnabSdkLaravel::class;
    }
}
