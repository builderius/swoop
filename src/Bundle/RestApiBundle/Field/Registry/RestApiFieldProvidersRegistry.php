<?php

namespace Swoop\Bundle\RestApiBundle\Field\Registry;

use Swoop\Bundle\KernelBundle\Boot\BootServiceInterface;
use Swoop\Bundle\RestApiBundle\Field\RestApiFieldProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RestApiFieldProvidersRegistry implements RestApiFieldProvidersRegistryInterface
{
    /**
     * @var RestApiFieldProviderInterface[]
     */
    private $providers = [];

    /**
     * @param RestApiFieldProviderInterface $provider
     */
    public function addProvider(RestApiFieldProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    /**
     * @inheritDoc
     */
    public function getRestApiFieldProviders()
    {
        return $this->providers;
    }
}
