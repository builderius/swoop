<?php

namespace Swoop\Bundle\RestApiBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\RestApiBundle\Controller\Processor\RestApiControllersProcessorInterface;
use Swoop\Bundle\RestApiBundle\Controller\Registry\RestApiControllersRegistryInterface;
use Swoop\Bundle\RestApiBundle\Endpoint\Processor\RestApiEndpointsProcessorInterface;
use Swoop\Bundle\RestApiBundle\Endpoint\Registry\RestApiEndpointsRegistryInterface;
use Swoop\Bundle\RestApiBundle\Field\Processor\RestApiFieldsProcessorInterface;
use Swoop\Bundle\RestApiBundle\Field\Registry\RestApiFieldProvidersRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RestApiBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_rest_endpoint',
                'swoop_rest_api.registry.rest_api.endpoints',
                'addEndpoint'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_rest_controller',
                'swoop_rest_api.registry.rest_api.controllers',
                'addController'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_rest_field_provider',
                'swoop_rest_api.registry.rest_api.field_providers',
                'addProvider'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var RestApiEndpointsRegistryInterface $restEndpointsRegistry */
        $restEndpointsRegistry = $this->container->get('swoop_rest_api.registry.rest_api.endpoints');
        /** @var RestApiEndpointsProcessorInterface $restEndpointsProcessor */
        $restEndpointsProcessor = $this->container->get('swoop_rest_api.processor.rest_api.endpoints');
        $restEndpointsProcessor->registerRestEndpoints($restEndpointsRegistry->getEndpoints());

        /** @var RestApiControllersRegistryInterface $restControllersRegistry */
        $restControllersRegistry = $this->container->get('swoop_rest_api.registry.rest_api.controllers');
        /** @var RestApiControllersProcessorInterface $restControllersProcessor */
        $restControllersProcessor = $this->container->get('swoop_rest_api.processor.rest_api.controllers');
        $restControllersProcessor->registerRestControllers($restControllersRegistry->getControllers());

        /** @var RestApiFieldProvidersRegistryInterface $restFieldProvidersRegistry */
        $restFieldProvidersRegistry = $this->container->get('swoop_rest_api.registry.rest_api.field_providers');
        /** @var RestApiFieldsProcessorInterface $restFieldsProcessor */
        $restFieldsProcessor = $this->container->get('swoop_rest_api.processor.rest_api.fields');
        $restFieldsProcessor->registerFields($restFieldProvidersRegistry->getRestApiFieldProviders());

        parent::boot();
    }
}
