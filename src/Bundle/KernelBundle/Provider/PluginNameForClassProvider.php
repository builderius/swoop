<?php

namespace Swoop\Bundle\KernelBundle\Provider;

use Swoop\Bundle\KernelBundle\Bundle\BundleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PluginNameForClassProvider
{
    /**
     * @var BundleInterface[]
     */
    private array $bundles;

    public function __construct(ContainerInterface $container)
    {
        $this->bundles = $container->get('kernel')->getBundles();
    }

    public function getPluginName(string $class, bool $full = true): ?string
    {
       foreach ($this->bundles as $name => $bundle) {
            if (str_contains($class, $bundle->getNamespace())) {
                if ($full === false) {
                    return explode('/', $bundle->getPluginName())[0];
                }

                return $bundle->getPluginName();
            }
        }

       return null;
    }
}