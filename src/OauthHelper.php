<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel;

use Illuminate\Support\Carbon;

final class OauthHelper
{
    public static function getAuthUrl()
    {
        $query = http_build_query([
            'client_id' => config('ynab-sdk-laravel.client.id'),
            'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
            'response_type' => config('ynab-sdk-laravel.response_type'),
        ]);

        return "https://app.ynab.com/oauth/authorize?$query";
    }

    public static function getExpirationTimeOfAccessToken(Carbon $dateRetrieved, int $expiresIn): Carbon
    {
        return Carbon::createFromTimestamp($dateRetrieved->getTimestamp() + $expiresIn);
    }
}