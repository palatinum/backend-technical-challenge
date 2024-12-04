<?php

namespace Tests\Unit\UseCases;

use PHPUnit\Framework\TestCase;
use Src\Application\ValidateTokenUseCase;
use Src\Domain\Services\TokenValidator;

class ValidateTokenUseCaseTest extends TestCase
{
    public function testGivenValidTokensShouldReturnTrue () {
        $validTokens = ['{}', '{}[]()', '{([])}', ''];
        foreach ($validTokens as $validToken) {
            $tokenValidator = new TokenValidator();
            $useCase = new ValidateTokenUseCase($tokenValidator);
            $valid = $useCase->__invoke($validToken);
            $this->assertTrue($valid);
        }
    }

    public function testGivenInvalidTokensShouldReturnFalse () {
        $inValidTokens = ['{)', '[{]}', '(((((((()', '@@@@@@', '123456789'];
        foreach ($inValidTokens as $inValidToken) {
            $tokenValidator = new TokenValidator();
            $useCase = new ValidateTokenUseCase($tokenValidator);
            $valid = $useCase->__invoke($inValidToken);
            $this->assertFalse($valid);
        }
    }
}
