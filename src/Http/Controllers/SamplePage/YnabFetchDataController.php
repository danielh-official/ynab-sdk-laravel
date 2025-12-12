<?php

declare(strict_types=1);

namespace YnabSdkLaravel\YnabSdkLaravel\Http\Controllers\SamplePage;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use YnabSdkLaravel\YnabSdkLaravel\Models\YnabUser;
use YnabSdkLaravel\YnabSdkLaravel\Ynab;

class YnabFetchDataController extends Controller
{
    public function __invoke(Request $request)
    {
        $accessToken = $request->cookie('ynab_access_token');

        $ynab = new Ynab($accessToken);

        $userInfoResponse = $ynab->user()->get();

        if ($userInfoResponse->failed()) {
            return to_route('ynab')->with('error', 'Failed to fetch user info.');
        }

        $userId = $userInfoResponse->json('data.user.id');

        YnabUser::updateOrCreate([
            'id' => $userId,
        ]);

        Cookie::queue('current_ynab_user', $userId);

        $budgetListResponse = $ynab->budgets()->list();

        if ($budgetListResponse->failed()) {
            return to_route('ynab')->with('error', 'Failed to fetch budgets.');
        }

        $budgetsData = $budgetListResponse->json();

        $budgets = $budgetListResponse->json('data.budgets', []);

        $serverKnowledge = $budgetListResponse->json('data.server_knowledge');

        $detailedBudgetsData = [];

        foreach ($budgets as $budget) {
            $id = $budget['id'] ?? null;

            if (! $id) {
                continue;
            }

            $budgetGetResponse = $ynab->budgets()->get($id, $serverKnowledge);

            if ($budgetGetResponse->failed()) {
                continue;
            }

            $detailedBudgetsData[$id] = $budgetGetResponse->json();
        }

        Cache::put(
            'ynabData_'.$userId,
            [
                'budgetsData' => $budgetsData,
                'detailedBudgetsData' => $detailedBudgetsData,
            ]
        );

        return to_route('ynab')
            ->with('success', 'Budgets fetched successfully.');
    }
}
