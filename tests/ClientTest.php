<?php
declare(strict_types=1);
/**
 * /tests/ClientTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace ValueFrame\Rest\Tests;

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
        static::assertSame(
            'https://psa.valueframe.com/rest/v2/resource',
            $this->client->getClient()->getConfig('base_uri')
        );
    }

    public function testThatGetOptionsAddsExpectedHeaders(): void
    {
        $options = $this->client->getOptions();

        static::assertArrayHasKey('X-VF-REST-USER', $options);
        static::assertArrayHasKey('X-VF-REST-TIMESTAMP', $options);
        static::assertArrayHasKey('X-VF-REST-HASH', $options);
    }

    protected function setUp()
    {
        $this->client = Factory::build('customer', 'token', 'resource');
    }
}

