<?php

namespace Swoop\Bundle\RestApiBundle\Endpoint\Registry;

use Swoop\Bundle\RestApiBundle\Endpoint\RestApiEndpointInterface;

class RestApiEndpointsRegistry implements RestApiEndpointsRegistryInterface
{
    private $endpoints = [];

    /**
     * @param RestApiEndpointInterface $endpoint
     */
    public function addEndpoint(RestApiEndpointInterface $endpoint)
    {
        $this->endpoints[] = $endpoint;
    }

    /**
     * @inheritDoc
     */
    public function getEndpoints()
    {
        return $this->endpoints;
    }
}