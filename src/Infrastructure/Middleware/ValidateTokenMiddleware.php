<?php

namespace Src\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\Request;
use Src\Application\ValidateTokenUseCase;

readonly class ValidateTokenMiddleware
{
    public function __construct(
        private ValidateTokenUseCase $validateTokenUseCase
    ){}

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken() ?? '';
        if (!$this->validateTokenUseCase->__invoke($token)) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        return $next($request);
    }
}
