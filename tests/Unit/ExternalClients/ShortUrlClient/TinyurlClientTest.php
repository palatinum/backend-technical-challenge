<?php

namespace Tests\Unit\ExternalClients\ShortUrlClient;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Src\Domain\Entities\Vo\UrlVo;
use Src\Infrastructure\ExternalClients\ShortUrlClient\TinyurlClient;

class TinyurlClientTest extends TestCase
{
    public function testCreateShortUrlSuccess()
    {
        $urlExpected = 'https://tinyurl.com/expected';
        $mock = new MockHandler([
            new Response(200, [], $urlExpected),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);
        $tinyurlClient = new TinyurlClient($httpClient);
        $urlVo = new UrlVo('http://www.example.com/aaaaaaaaa/bbbbbbbbbbbb/ccccccccccccc');
        $shortUrlVo = $tinyurlClient->createShortUrl($urlVo);
        $this->assertEquals($urlExpected, $shortUrlVo->value());
    }

    public function testCreateShortUrlFailure()
    {
        $mock = new MockHandler([
            new Response(500, [], 'Internal Server Error'),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $httpClient = new Client(['handler' => $handlerStack]);
        $tinyurlClient = new TinyurlClient($httpClient);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Internal Server Error');
        $urlVo = new UrlVo('http://www.example.com/aaaaaaaaa/bbbbbbbbbbbb/ccccccccccccc');
        $tinyurlClient->createShortUrl($urlVo);
    }
}
