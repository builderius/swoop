<?php

namespace Swoop\Bundle\KernelBundle\Boot;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface BootServiceInterface
{
    public function boot(ContainerInterface $container): void;
}
