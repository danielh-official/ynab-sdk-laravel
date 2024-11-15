<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RefreshTokenRetrieved
{
    use Dispatchable, SerializesModels;

    public function __construct(public string $refreshToken) {}
}
