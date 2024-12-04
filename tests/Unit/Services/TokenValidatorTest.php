<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use Src\Domain\Entities\Vo\TokenVo;
use Src\Domain\Services\TokenValidator;

class TokenValidatorTest extends TestCase
{
    public function testGivenValidTokensIsBracketBalancedShouldReturnTrue () {
        $validTokens = ['{}', '{}[]()', '{([])}', ''];
        foreach ($validTokens as $validToken) {
            $tokenVo = new TokenVo($validToken);
            $tokenValidator = new TokenValidator();
            $valid = $tokenValidator->isBracketBalanced($tokenVo);
            $this->assertTrue($valid);
        }
    }

    public function testGivenInvalidTokensIsBracketBalancedShouldReturnFalse () {
        $inValidTokens = ['{)', '[{]}', '(((((((()'];
        foreach ($inValidTokens as $inValidToken) {
            $tokenVo = new TokenVo($inValidToken);
            $tokenValidator = new TokenValidator();
            $valid = $tokenValidator->isBracketBalanced($tokenVo);
            $this->assertFalse($valid);
        }
    }

    public function testGivensValidCharactersHasValidCharactersShouldReturnTrue () {
        $validTokens = ['()', '{}', '[]', ''];
        foreach ($validTokens as $validToken) {
            $tokenVo = new TokenVo($validToken);
            $tokenValidator = new TokenValidator();
            $valid = $tokenValidator->hasValidCharacters($tokenVo);
            $this->assertTrue($valid);
        }
    }

    public function testGivensInValidCharactersHasValidCharactersShouldReturnFalse () {
        $validTokens = ['123456789', 'testing', '@@***', '///|||.,'];
        foreach ($validTokens as $validToken) {
            $tokenVo = new TokenVo($validToken);
            $tokenValidator = new TokenValidator();
            $valid = $tokenValidator->hasValidCharacters($tokenVo);
            $this->assertFalse($valid);
        }
    }
}
