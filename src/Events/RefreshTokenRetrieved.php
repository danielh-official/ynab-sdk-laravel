<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class RefreshTokenRetrieved
{
    use Dispatchable, SerializesModels;

    public function __construct(public string $refreshToken, public Carbon $dateRetrieved) {}
}
