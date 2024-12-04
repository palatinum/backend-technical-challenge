<?php

namespace Src\Domain\Services;

use Src\Domain\Entities\Vo\TokenVo;

class TokenValidator
{
    /**
     * @param TokenVo $tokenVo
     * @return bool
     */
    public function isBracketBalanced(TokenVo $tokenVo): bool
    {
        $bracketStack = [];
        $openingBrackets = ['(', '{', '['];
        $closingBrackets = [')', '}', ']'];
        $bracketPairs = array_combine($closingBrackets, $openingBrackets);

        foreach (str_split($tokenVo->value()) as $char) {
            if (in_array($char, $openingBrackets, true)) {
                $bracketStack[] = $char;
            }
            elseif (in_array($char, $closingBrackets, true)) {
                $lastOpeningBracket = array_pop($bracketStack);
                if ($lastOpeningBracket !== $bracketPairs[$char]) {
                    return false;
                }
            }
        }
        return empty($bracketStack);
    }

    /**
     * @param TokenVo $tokenVo
     * @return bool
     */
    public function hasValidCharacters(TokenVo $tokenVo): bool
    {
        return preg_match('/^[\(\)\{\}\[\]]*$/', $tokenVo->value());
    }
}
