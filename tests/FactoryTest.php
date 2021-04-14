<?php
declare(strict_types=1);
/**
 * /tests/FactoryTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@pinja.com>
 */
namespace ValueFrame\Rest\Tests;

use PHPUnit\Framework\TestCase;
use ValueFrame\Rest\Factory;

/**
 * Class FactoryTest
 *
 * @package ValueFrame\Rest\Tests
 */
class FactoryTest extends TestCase
{
    public function testThatClientHasBeenCreatedWithCorrectParameters(): void
    {
        $client = Factory::build('customer', 'token', 'resource');

        static::assertSame('customer', $client->getCustomer());
        static::assertSame('token', $client->getToken());
        static::assertSame('resource', $client->getResource());
    }

    public function testThatClientHasDefaultBaseUri(): void
    {
        $client = Factory::build('customer', 'token', 'resource');

        static::assertSame('https://rest.valueframe.com/rest/v2/', $client->getBaseUri());
    }

    public function testThatClientHasCustomBaseUri(): void
    {
        $client = Factory::build('customer', 'token', 'resource', 'custom');

        static::assertSame('custom', $client->getBaseUri());
    }
}
