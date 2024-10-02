<?php

namespace Swoop\Bundle\RestApiBundle\Endpoint\Registrator;

use Swoop\Bundle\RestApiBundle\Endpoint\RestApiEndpointInterface;

interface RestApiEndpointsRegistratorInterface
{
    /**
     * @param RestApiEndpointInterface[] $endpoints
     */
    public function registerRestEndpoints(array $endpoints);
}