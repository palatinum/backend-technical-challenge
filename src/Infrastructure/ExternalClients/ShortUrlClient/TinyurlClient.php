<?php

namespace Src\Infrastructure\ExternalClients\ShortUrlClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Src\Domain\Clients\ShortUrlClient;
use Src\Domain\Entities\Vo\ShortUrlVo;
use Src\Domain\Entities\Vo\UrlVo;

class TinyurlClient implements ShortUrlClient
{
    /**
     * @var string
     */
    private string $apiEndpoint = 'https://tinyurl.com/api-create.php';
    public function __construct(
        private readonly Client $httpClient
    ){}

    /**
     * @param UrlVo $urlVo
     * @return ShortUrlVo
     * @throws GuzzleException
     */
    public function createShortUrl(UrlVo $urlVo): ShortUrlVo
    {
        $response = $this->httpClient->request('GET', $this->apiEndpoint, [
            'query' => ['url' => $urlVo->value()],
        ]);
        return new ShortUrlVo((string) $response->getBody());
    }
}
