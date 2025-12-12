<?php

namespace YnabSdkLaravel\YnabSdkLaravel;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use YnabSdkLaravel\YnabSdkLaravel\Events\AccessTokenRetrieved;
use YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\SamplePage\YnabFetchDataController;
use YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\SamplePage\YnabSamplePageController;
use YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\YnabCallbackController;
use YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\YnabRefreshController;
use YnabSdkLaravel\YnabSdkLaravel\Listeners\StoreAccessToken;

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
            ->hasMigration('create_ynab_users_table');
    }

    public function packageRegistered()
    {
        Route::macro('ynabSdkLaravelOauth', function () {
            $baseUrl = config('ynab-sdk-laravel.oauth.base_url');
            $baseName = config('ynab-sdk-laravel.oauth.base_name').'.';

            Route::prefix($baseUrl)->name($baseName)->group(function () {
                Route::get('/callback', YnabCallbackController::class)->name('callback');
                Route::get('/refresh', YnabRefreshController::class)->name('refresh');
            });
        });

        Route::macro('ynabSdkLaravelSamplePage', function () {
            Route::get('/ynab', YnabSamplePageController::class)->name('ynab');

            Route::post('/ynab/fetch', YnabFetchDataController::class)->name('ynab.fetch');

            $dataTypes = Get::ynabTypes();

            foreach ($dataTypes as $dataType) {
                Route::get("ynab/{budget}/$dataType", function ($budget) use ($dataType) {
                    $ynabData = Cache::get('ynabData_'.Cookie::get('current_ynab_user'), []);

                    $data = $ynabData['detailedBudgetsData'][$budget]['data']['budget'][$dataType] ?? [];

                    return response()->json($data, 200, [], JSON_PRETTY_PRINT);
                })->name("ynab.$dataType");
            }

            Event::listen(
                AccessTokenRetrieved::class,
                StoreAccessToken::class
            );
        });
    }
}
