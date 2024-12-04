<?php

namespace Tests\Feature;

use Src\Application\Responses\ShortUrlResponse;
use Src\Application\ShortUrlUseCase;
use Tests\TestCase;

class ShortUrlControllerTest extends TestCase
{
    public function testShortUrlReturnSuccessUrl()
    {
        $url = 'http://www.example.com/aaaaaaaaa/bbbbbbbbbbbb/ccccccccccccc';
        $shortUrlResponse = new ShortUrlResponse('https://tinyurl.com/expected');
        $shortUrlUseCase = $this->createMock(ShortUrlUseCase::class);
        $shortUrlUseCase->method('__invoke')
            ->with($url)
            ->willReturn($shortUrlResponse);

        $this->app->bind(ShortUrlUseCase::class, function () use ($shortUrlUseCase) {
            return $shortUrlUseCase;
        });
        $response = $this->postJson('/api/v1/short-urls', [
            'url' => $url,
        ]);
        $response->assertStatus(200)
            ->assertJson($shortUrlResponse->jsonSerialize());
    }
}
