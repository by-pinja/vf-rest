<?php
declare(strict_types = 1);
/**
 * /src/Factory.php
 *
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
namespace ValueFrame\Rest;

/**
 * Class Factory
 *
 * @package ValueFrame\Rest
 * @author  TLe, Tarmo Leppänen <tarmo.leppanen@protacon.com>
 */
class Factory
{
    /**
     * Factory method
     *
     * @param string $customer Customer
     * @param string $token    Resource token
     * @param string $resource Rest resource
     *
     * @return Client
     */
    public static function build($customer, $token, $resource): Client
    {
        $client = (new Client())
            ->setCustomer($customer)
            ->setToken($token)
            ->setResource($resource);

        return $client;
    }
}
