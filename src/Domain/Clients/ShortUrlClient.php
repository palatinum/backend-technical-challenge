<?php

namespace Src\Domain\Clients;
use Src\Domain\Entities\Vo\ShortUrlVo;
use Src\Domain\Entities\Vo\UrlVo;

interface ShortUrlClient
{
    /**
     * @param UrlVo $urlVo
     * @return ShortUrlVo
     */
    public function createShortUrl(UrlVo $urlVo): ShortUrlVo;
}
