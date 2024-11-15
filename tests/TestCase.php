<?php

namespace DanielHaven\YnabSdkLaravel\Tests;

use DanielHaven\YnabSdkLaravel\YnabSdkLaravelServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected ?array $json = null;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'DanielHaven\\YnabSdkLaravel\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            YnabSdkLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $app->setBasePath(__DIR__.'/..');

        /*
        $migration = include __DIR__.'/../database/migrations/create_ynab-sdk-laravel_table.php.stub';
        $migration->up();
        */
    }
}
