<?php

namespace Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Domain\Clients\ShortUrlClient;
use Src\Infrastructure\ExternalClients\ShortUrlClient\TinyurlClient;

class ClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ShortUrlClient::class, TinyurlClient::class);
    }
}
