<?php

use Illuminate\Support\Facades\Route;
use Src\Infrastructure\Controllers\ShortUrlController;

Route::post('/v1/short-urls', ShortUrlController::class);
