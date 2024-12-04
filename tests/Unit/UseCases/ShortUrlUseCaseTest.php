<?php

namespace Tests\Unit\UseCases;

use PHPUnit\Framework\TestCase;
use Src\Application\ShortUrlUseCase;
use Src\Domain\Entities\Vo\ShortUrlVo;
use Src\Domain\Entities\Vo\UrlVo;
use Src\Infrastructure\ExternalClients\ShortUrlClient\TinyurlClient;

class ShortUrlUseCaseTest extends TestCase
{
    public function testGivenUrlVoShouldReturnShortUrlResponse () {
        $urlInput = 'url';
        $urlExpected = 'short-url';
        $urlVo = new UrlVo($urlInput);
        $shortUrlVo = new ShortUrlVo($urlExpected);

        $client = $this->createMock(TinyurlClient::class);
        $client->expects($this->once())
            ->method('createShortUrl')
            ->with($urlVo)
            ->willReturn($shortUrlVo);

        $useCase = new ShortUrlUseCase($client);
        $shortUrlResponse = $useCase->__invoke($urlVo->value());

        $this->assertEquals($urlExpected, $shortUrlResponse->url);
    }
}
