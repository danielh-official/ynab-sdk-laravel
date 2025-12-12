<?php

declare(strict_types=1);

namespace YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\SamplePage;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use YnabSdkLaravel\YnabSdkLaravel\Get;
use YnabSdkLaravel\YnabSdkLaravel\Models\YnabUser;

class YnabSamplePageController extends Controller
{
    public function __invoke(Request $request)
    {
        $dataTypes = Get::ynabTypes();

        $timezone = $request->get('timezone') ?? config('app.timezone');

        $expiresIn = intval(Cookie::get('ynab_expires_in'));
        $dateRetrieved = Carbon::parse(Cookie::get('ynab_date_retrieved'));

        $data = [
            'ynabAuthUrl' => Get::authUrl(),
            'dateRetrieved' => $dateRetrieved
                ->timezone($timezone)
                ->format('m/d/Y h:i:s A T'),
            'expiresIn' => $expiresIn,
            'ynabDataTypes' => $dataTypes,
        ];

        if ($expiresIn && $dateRetrieved) {
            $expirationTimeOfAccessToken = Get::expirationTimeOfAccessToken(
                $dateRetrieved,
                $expiresIn
            );

            $data['expirationTimeOfAccessToken'] = $expirationTimeOfAccessToken;

            $data['seconds'] = round(now()->diffInSeconds($expirationTimeOfAccessToken), 0);

            $data['hasUnexpiredToken'] = $data['seconds'] > 0;
        }

        $currentYnabUserId = Cookie::get('current_ynab_user');

        if ($currentYnabUserId) {
            $data['currentYnabUser'] = YnabUser::find($currentYnabUserId);

            $data['ynabData'] = Cache::get('ynabData_'.$currentYnabUserId, []);

            $data['defaultBudget'] = $data['ynabData']['budgetsData']['data']['default_budget']['id'] ?? null;
        }

        return view('ynab-sdk-laravel::ynab', $data);
    }
}
