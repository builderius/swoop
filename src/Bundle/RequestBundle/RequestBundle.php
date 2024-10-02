<?php

namespace Swoop\Bundle\RequestBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\RequestBundle\Handler\Registrator\RequestHandlersRegistratorInterface;
use Swoop\Bundle\RequestBundle\Registry\RequestHandlersRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RequestBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_request_handler',
                'swoop_request.registry.request_handlers',
                'addHandler'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var RequestHandlersRegistryInterface $requestHandlersRegistry */
        $requestHandlersRegistry = $this->container->get('swoop_request.registry.request_handlers');
        /** @var RequestHandlersRegistratorInterface $requestHandlersRegistrator */
        $requestHandlersRegistrator = $this->container->get('swoop_request.handlers_registrator.main');
        $requestHandlersRegistrator->registerRequestHandlers($requestHandlersRegistry->getHandlers());

        parent::boot();
    }
}
