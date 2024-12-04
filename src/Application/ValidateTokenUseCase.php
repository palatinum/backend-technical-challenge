<?php

namespace Src\Application;

use Src\Domain\Entities\Vo\TokenVo;
use Src\Domain\Services\TokenValidator;

readonly class ValidateTokenUseCase
{
    public function __construct(
        private TokenValidator $tokenValidator
    ) {}

    /**
     * @param string $token
     * @return bool
     */
    public function __invoke(string $token): bool
    {
        return $this->tokenValidator->hasValidCharacters(new TokenVo($token)) &&
            $this->tokenValidator->isBracketBalanced(new TokenVo($token));
    }
}
