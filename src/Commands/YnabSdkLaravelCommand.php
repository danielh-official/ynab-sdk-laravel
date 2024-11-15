<?php

namespace DanielHaven\YnabSdkLaravel\Commands;

use Illuminate\Console\Command;

class YnabSdkLaravelCommand extends Command
{
    public $signature = 'ynab-sdk-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
