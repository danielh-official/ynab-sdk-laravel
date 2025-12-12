<?php

namespace YnabSdkLaravel\YnabSdkLaravel;

use Illuminate\Support\Carbon;

final class Get
{
    public static function ynabTypes()
    {
        return [
            'accounts',
            'payees',
            'payee_locations',
            'category_groups',
            'categories',
            'months',
            'transactions',
            'subtransactions',
            'scheduled_transactions',
            'scheduled_subtransactions',
        ];
    }

    public static function authUrl()
    {
        return OauthHelper::getAuthUrl();
    }

    public static function expirationTimeOfAccessToken(Carbon $dateRetrieved, int $expiresIn): Carbon
    {
        return OauthHelper::getExpirationTimeOfAccessToken($dateRetrieved, $expiresIn);
    }
}
