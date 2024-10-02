<?php

namespace Swoop\Bundle\KernelBundle\Boot;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface BootServiceInterface
{
    /**
     * @param ContainerInterface $container
     */
    public function boot(ContainerInterface $container);
}
