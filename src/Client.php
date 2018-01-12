<?php
declare(strict_types = 1);
/**
 * /src/Client.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace ValueFrame\Rest;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Promise;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class Client
 *
 * @method ResponseInterface get(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface head(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface put(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface post(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface patch(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface delete(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface getAsync(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface headAsync(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface putAsync(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface postAsync(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface patchAsync(string|UriInterface $uri, array $options = [])
 * @method Promise\PromiseInterface deleteAsync(string|UriInterface $uri, array $options = [])
 *
 * @package ValueFrame\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Client
{
    /**
     * @var string
     */
    private $customer;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $resource;

    /**
     * @var string
     */
    private $baseUri = 'https://psa.valueframe.com/rest/v2/';

    /**
     * @param string $method
     * @param array  $args
     *
     * @return \GuzzleHttp\Promise\PromiseInterface|mixed|ResponseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function __call(string $method, array $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = $args[1] ?? [];

        return substr($method, -5) === 'Async'
            ? $this->getClient()->requestAsync(substr($method, 0, -5), $uri, $this->getOptions($opts))
            : $this->getClient()->request($method, $uri, $this->getOptions($opts));
    }

    /**
     * @return string
     */
    public function getCustomer(): string
    {
        return $this->customer;
    }

    /**
     * @param string $customer
     *
     * @return Client
     */
    public function setCustomer(string $customer): Client
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return Client
     */
    public function setToken(string $token): Client
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getResource(): string
    {
        return $this->resource;
    }

    /**
     * @param string $resource
     *
     * @return Client
     */
    public function setResource(string $resource): Client
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string|null $baseUri
     *
     * @return Client
     */
    public function setBaseUri(string $baseUri = null): Client
    {
        $this->baseUri = $baseUri ?? $this->baseUri;

        return $this;
    }

    /**
     * @return GuzzleClient
     */
    public function getClient(): GuzzleClient
    {
        return new GuzzleClient([
            'base_uri' =>  $this->getBaseUri() . $this->getResource(),
        ]);
    }

    /**
     * @param array|null $options
     *
     * @return array
     */
    public function getOptions(array $options = null): array
    {
        return \array_merge($this->getHeaders(), $options ?? []);
    }

    /**
     * @return array
     */
    private function getHeaders(): array
    {
        $timestamp = \time();
        $resource = \trim($this->getResource(), '/');

        return [
            'headers' => [
                'X-VF-REST-USER'      => $this->getCustomer(),
                'X-VF-REST-TIMESTAMP' => $timestamp,
                'X-VF-REST-HASH'      => \md5($timestamp . '/' . $resource . '/' . $this->getToken()),
            ],
        ];
    }
}
