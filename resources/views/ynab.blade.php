<x-ynab-sdk-laravel::layouts.main title="YNAB Page">
    <div>
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Back Home</a>
    </div>
    <div class="mt-10 flex gap-x-2">
        <x-ynab-sdk-laravel::oauth-button />
        @if ($hasUnexpiredToken)
            <form action="{{ route('ynab.fetch') }}" method="POST">
                @csrf

                <button
                    class="bg-[#5865F2] text-white px-4 py-2 rounded flex gap-x-2 items-center hover:bg-[#4752c4] cursor-pointer">Fetch
                    Data</button>
            </form>
        @endif
    </div>
    <div class="flex flex-col gap-y-2 mt-12">
        <div>
            <x-ynab-sdk-laravel::countdown :seconds="$seconds">
                <x-slot:time-remaining-label>
                    <span class="text-gray-700 dark:text-gray-400">Time remaining:</span>
                </x-slot:time-remaining-label>

                <x-slot:finished-text>
                    <span class="text-red-500">Expired</span>
                </x-slot:finished-text>
            </x-ynab-sdk-laravel::countdown>
        </div>
        <div>
            <span class="text-gray-700 dark:text-gray-400">Date Retrieved:</span> {{ $dateRetrieved ?? 'N/A' }}
        </div>
        <div>
            <span class="text-gray-700 dark:text-gray-400">Expires In:</span> {{ $expiresIn ?? 'N/A' }} seconds
        </div>
    </div>
    <div class="my-6">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Budgets</h2>
    </div>
    <div>
        @foreach ($ynabData['budgetsData']['data']['budgets'] ?? [] as $budget)
            <div class="mb-4 flex flex-col gap-y-1 border border-gray-200 p-4">
                <span class="text-gray-700 dark:text-gray-400">Budget ID:</span> {{ $budget['id'] ?? 'N/A' }}
                <span class="text-gray-700 dark:text-gray-400">Budget Name:</span>
                {{ $budget['name'] ?? 'N/A' }}
                <span class="text-gray-700 dark:text-gray-400">Last Modified On:</span>
                {{ $budget['last_modified_on'] ?? 'N/A' }}
                <span class="text-gray-700 dark:text-gray-400">Is Default:</span>
                {{ $budget['id'] === $defaultBudget ? 'Yes' : 'No' }}
                <hr class="my-4" />
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($ynabDataTypes as $dataType)
                        <div>
                            <a href="{{ route("ynab.$dataType", $budget['id']) }}" class="text-blue-500 hover:underline"
                                target="_blank">{{ ucfirst(str_replace('_', ' ', $dataType)) }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</x-ynab-sdk-laravel::layouts.main>
