<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Http\Controllers;

use DanielHaven\YnabSdkLaravel\Events\AccessTokenRetrieved;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class YnabCallbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = [
            'client_id' => config('ynab-sdk-laravel.client.id'),
            'client_secret' => config('ynab-sdk-laravel.client.secret'),
            'redirect_uri' => config('ynab-sdk-laravel.redirect_uri'),
            'grant_type' => $request->query('grant_type', 'authorization_code'),
            'code' => $request->query('code'),
        ];

        if ($request->boolean('use_readonly_scope')) {
            $query['scope'] = 'read-only';
        }

        if ($request->string('state')) {
            $query['state'] = $request->string('state');
        }

        $query = http_build_query($query);

        $ynabRequest = Http::post("https://app.ynab.com/oauth/token?$query")->throw();

        $redirectTo = $request->string('redirect_to', 'home')->toString();

        if ($ynabRequest->json('access_token')) {
            AccessTokenRetrieved::dispatch($ynabRequest->json(), now());

            return redirect()->route($redirectTo)->with('success', 'Access token retrieved');
        } else {
            return redirect()->route($redirectTo)->with('error', 'Failed to get access token');
        }
    }
}
