<?php

namespace Swoop\Bundle\RestApiBundle\Endpoint\Registry;

use Swoop\Bundle\RestApiBundle\Endpoint\RestApiEndpointInterface;

interface RestApiEndpointsRegistryInterface
{
    /**
     * @return RestApiEndpointInterface[]
     */
    public function getEndpoints();
}