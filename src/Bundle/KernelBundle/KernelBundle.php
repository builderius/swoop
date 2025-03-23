<?php

namespace Swoop\Bundle\KernelBundle;

use Swoop\Bundle\KernelBundle\Boot\BootServiceInterface;
use Swoop\Bundle\KernelBundle\Boot\CompositeBootService;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\RegisterListenersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class KernelBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                CompositeBootService::TAG,
                'swoop_kernel.boot_service.composite',
                'addService'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'twig.extension',
                'twig',
                'addExtension'
            )
        );
        $container->addCompilerPass(
            new RegisterListenersPass(
                'event_dispatcher',
                'swoop_event_listener',
                'swoop_event_subscriber'
            )
        );
    }

    public function boot(): void
    {
        /** @var BootServiceInterface $compositeBoot */
        $compositeBoot = $this->container->get('swoop_kernel.boot_service.composite');
        $compositeBoot->boot($this->container);

        parent::boot();
    }
}
