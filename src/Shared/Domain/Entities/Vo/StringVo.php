<?php

namespace Src\Shared\Domain\Entities\Vo;

readonly class StringVo
{
    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ){}

    /**
     * @return string
     */
    public function value (): string
    {
        return $this->value;
    }
}
