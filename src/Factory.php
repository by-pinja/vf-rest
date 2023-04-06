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
     * @param string      $customer Customer
     * @param string      $token    Resource token
     * @param string      $resource Rest resource
     * @param string|null $baseUri
     *
     * @return Client
     */
    public static function build(string $customer, string $token, string $resource, string $baseUri = null): Client
    {
        return (new Client())
            ->setCustomer($customer)
            ->setToken($token)
            ->setResource($resource)
            ->setBaseUri($baseUri);
    }
}
