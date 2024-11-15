<?php

namespace DanielHaven\YnabSdkLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use DanielHaven\YnabSdkLaravel\Commands\YnabSdkLaravelCommand;

class YnabSdkLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ynab-sdk-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ynab_sdk_laravel_table')
            ->hasCommand(YnabSdkLaravelCommand::class);
    }
}
