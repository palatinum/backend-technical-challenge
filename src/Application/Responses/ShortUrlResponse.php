<?php

namespace Src\Application\Responses;

use JsonSerializable;

class ShortUrlResponse implements JsonSerializable
{
    public function __construct(
        public string $url
    ){}

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}
