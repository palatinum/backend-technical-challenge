<?php

namespace Src\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Src\Application\ShortUrlUseCase;
use Src\Infrastructure\Requests\ShortUrlRequest;

class ShortUrlController extends Controller
{
    public function __construct(
        private readonly ShortUrlUseCase $shortUrlUseCase
    ){}

    public function __invoke(ShortUrlRequest $request): JsonResponse
    {
        $shortUrl = $this->shortUrlUseCase->__invoke($request->input('url'));
        return response()->json($shortUrl->jsonSerialize(), 200);
    }
}
