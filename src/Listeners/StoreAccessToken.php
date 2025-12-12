<?php

namespace YnabSdkLaravel\YnabSdkLaravel\Listeners;

use Illuminate\Support\Facades\Cookie;
use YnabSdkLaravel\YnabSdkLaravel\Events\AccessTokenRetrieved;

class StoreAccessToken
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AccessTokenRetrieved $event): void
    {
        Cookie::queue('ynab_access_token', $event->data['access_token'], 60 * 24 * 30); // Store for 30 days
        Cookie::queue('ynab_refresh_token', $event->data['refresh_token'], 60 * 24 * 30); // Store for 30 days
        Cookie::queue('ynab_token_type', $event->data['token_type'], 60 * 24 * 30); // Store for 30 days
        Cookie::queue('ynab_expires_in', $event->data['expires_in'], 60 * 24 * 30); // Store for 30 days
        Cookie::queue('ynab_date_retrieved', $event->retrievedAt, 60 * 24 * 30); // Store for 30 days
    }
}
