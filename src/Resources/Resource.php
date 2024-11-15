<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Resources;

use Illuminate\Http\Client\PendingRequest;

class Resource
{
    public function __construct(
        protected PendingRequest $client,
    ) {}
}
