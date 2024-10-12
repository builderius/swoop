<?php

namespace Swoop\Bundle\RestApiBundle\Endpoint\Processor;

use Swoop\Bundle\RestApiBundle\Endpoint\RestApiEndpointInterface;

interface RestApiEndpointsProcessorInterface
{
    /**
     * @param RestApiEndpointInterface[] $endpoints
     */
    public function registerRestEndpoints(array $endpoints);
}