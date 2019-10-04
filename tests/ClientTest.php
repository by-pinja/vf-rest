<?php
declare(strict_types=1);
/**
 * /tests/ClientTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace ValueFrame\Rest\Tests;

use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;
use ValueFrame\Rest\Client;
use ValueFrame\Rest\Factory;

/**
 * Class ClientTest
 *
 * @package ValueFrame\Rest\Tests
 */
class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function testThatGetClientUsesExpectedBaseUri(): void
    {
        /** @var Uri $baseUri */
        $baseUri = $this->client->getClient()->getConfig('base_uri');

        static::assertSame('https', $baseUri->getScheme());
        static::assertSame('psa.valueframe.com', $baseUri->getHost());
        static::assertSame('/rest/v2/resource', $baseUri->getPath());
    }

    public function testThatGetOptionsAddsExpectedHeaders(): void
    {
        $options = $this->client->getOptions()['headers'];

        static::assertArrayHasKey('X-VF-REST-USER', $options);
        static::assertArrayHasKey('X-VF-REST-TIMESTAMP', $options);
        static::assertArrayHasKey('X-VF-REST-HASH', $options);
    }

    protected function setUp(): void
    {
        $this->client = Factory::build('customer', 'token', 'resource');
    }
}

