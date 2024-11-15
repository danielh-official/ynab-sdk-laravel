<?php

declare(strict_types=1);

namespace DanielHaven\YnabSdkLaravel\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccessTokenRetrieved
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public string $accessToken,
        public ?int $expiresIn = null,
    ) {}
}
