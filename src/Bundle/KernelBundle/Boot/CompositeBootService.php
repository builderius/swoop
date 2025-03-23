<?php

namespace Swoop\Bundle\KernelBundle\Boot;

use Symfony\Component\DependencyInjection\ContainerInterface;

class CompositeBootService implements BootServiceInterface
{
    const TAG = 'swoop_boot_service';

    /**
     * @var BootServiceInterface[]
     */
    private array $services = [];

    public function addService(BootServiceInterface $service): static
    {
        $this->services[] = $service;

        return $this;
    }

    public function boot(ContainerInterface $container): void
    {
        foreach ($this->services as $service) {
            $service->boot($container);
        }
    }
}
