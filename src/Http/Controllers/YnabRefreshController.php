<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Http\Controllers;

use DanielHaven\YnabSdkLaravel\Events\AccessTokenRetrieved;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class YnabRefreshController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = [
            'client_id' => config('ynab-sdk-laravel.client.id'),
            'client_secret' => config('ynab-sdk-laravel.client.secret'),
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->query('refresh_token'),
        ];

        $query = http_build_query($query);

        $ynabRequest = Http::post("https://app.ynab.com/oauth/token?$query")->throw();

        $redirectTo = $request->string('redirect_to', 'home')->toString();

        if ($ynabRequest->json('access_token')) {
            AccessTokenRetrieved::dispatch($ynabRequest->json(), now());

            return redirect()->route($redirectTo)->with('success', 'New access token retrieved');
        } else {
            return redirect()->route($redirectTo)->with('error', 'Failed to get new access token');
        }
    }
}
