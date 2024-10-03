<?php

namespace Swoop\Bundle\RestApiBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\RestApiBundle\Controller\Registrator\RestApiControllersRegistratorInterface;
use Swoop\Bundle\RestApiBundle\Controller\Registry\RestApiControllersRegistryInterface;
use Swoop\Bundle\RestApiBundle\Endpoint\Registrator\RestApiEndpointsRegistratorInterface;
use Swoop\Bundle\RestApiBundle\Endpoint\Registry\RestApiEndpointsRegistryInterface;
use Swoop\Bundle\RestApiBundle\Field\Registrator\RestApiFieldsRegistratorInterface;
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
        /** @var RestApiEndpointsRegistratorInterface $restEndpointsRegistrator */
        $restEndpointsRegistrator = $this->container->get('swoop_rest_api.registrator.rest_api.endpoints');
        $restEndpointsRegistrator->registerRestEndpoints($restEndpointsRegistry->getEndpoints());

        /** @var RestApiControllersRegistryInterface $restControllersRegistry */
        $restControllersRegistry = $this->container->get('swoop_rest_api.registry.rest_api.controllers');
        /** @var RestApiControllersRegistratorInterface $restControllersRegistrator */
        $restControllersRegistrator = $this->container->get('swoop_rest_api.registrator.rest_api.controllers');
        $restControllersRegistrator->registerRestControllers($restControllersRegistry->getControllers());

        /** @var RestApiFieldProvidersRegistryInterface $restFieldProvidersRegistry */
        $restFieldProvidersRegistry = $this->container->get('swoop_rest_api.registry.rest_api.field_providers');
        /** @var RestApiFieldsRegistratorInterface $restFieldsRegistrator */
        $restFieldsRegistrator = $this->container->get('swoop_rest_api.registrator.rest_api.fields');
        $restFieldsRegistrator->registerFields($restFieldProvidersRegistry->getRestApiFieldProviders());

        parent::boot();
    }
}
