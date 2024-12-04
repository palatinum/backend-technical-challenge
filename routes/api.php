<?php

use Illuminate\Support\Facades\Route;
use Src\Infrastructure\Controllers\ShortUrlController;
use Src\Infrastructure\Middleware\ValidateTokenMiddleware;

Route::middleware([ValidateTokenMiddleware::class])->group(function () {
    Route::post('/v1/short-urls', ShortUrlController::class);
});
