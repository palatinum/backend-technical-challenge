<?php

namespace Src\Application;

use Src\Application\Responses\ShortUrlResponse;
use Src\Domain\Clients\ShortUrlClient;
use Src\Domain\Entities\Vo\UrlVo;

readonly class ShortUrlUseCase
{
    /**
     * @param ShortUrlClient $shortUrlClient
     */
    public function __construct(
        private ShortUrlClient $shortUrlClient
    ){}

    /**
     * @param string $url
     * @return ShortUrlResponse
     */
    public function __invoke(string $url): ShortUrlResponse
    {
        $urlVo = new UrlVo($url);
        $shortUrl = $this->shortUrlClient->createShortUrl($urlVo);
        return new ShortUrlResponse($shortUrl->value());
    }
}
