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

        $this->assertSame('https', $baseUri->getScheme());
        $this->assertSame('rest.valueframe.com', $baseUri->getHost());
        $this->assertSame('/rest/v2/resource', $baseUri->getPath());
    }

    public function testThatGetOptionsAddsExpectedHeaders(): void
    {
        $options = $this->client->getOptions()['headers'];

        $this->assertArrayHasKey('X-VF-REST-USER', $options);
        $this->assertArrayHasKey('X-VF-REST-TIMESTAMP', $options);
        $this->assertArrayHasKey('X-VF-REST-HASH', $options);
    }

    protected function setUp(): void
    {
        $this->client = Factory::build('customer', 'token', 'resource');
    }
}
