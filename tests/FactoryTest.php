<?php
declare(strict_types=1);
/**
 * /tests/FactoryTest.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
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
    public function testThatClientHasBeenCreatedWithCorrectParameters()
    {
        $client = Factory::build('customer', 'token', 'resource');

        static::assertSame('customer', $client->getCustomer());
        static::assertSame('token', $client->getToken());
        static::assertSame('resource', $client->getResource());
    }
}
