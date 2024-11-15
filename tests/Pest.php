<?php

use DanielHaven\YnabSdkLaravel\Tests\TestCase;
use Illuminate\Support\Facades\Route;

uses(TestCase::class)
    ->beforeEach(function () {
        Route::ynabSdkLaravelOauth();

        Route::get('/', function () {
            return 'Hello World';
        })->name('home');
    })
    ->in(__DIR__);
