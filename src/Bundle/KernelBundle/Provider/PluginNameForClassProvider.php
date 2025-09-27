<?php

namespace Swoop\Bundle\KernelBundle\Provider;

use Swoop\Bundle\KernelBundle\Bundle\BundleInterface;
use Swoop\Bundle\KernelBundle\Kernel\Kernel;

class PluginNameForClassProvider
{
    /**
     * @var BundleInterface[]
     */
    private $bundles;

    /**
     * @param Kernel $kernel
     */
    public function __construct(Kernel $kernel)
    {
        $this->bundles = $kernel->getBundles();
    }

    /**
     * @param string $class
     * @param bool $full
     * @return string
     */
    public function getPluginName($class, $full = true)
    {
       foreach ($this->bundles as $name => $bundle) {
            if (strpos($class, $bundle->getNamespace()) !== false) {
                if ($full === false) {
                    return explode('/', $bundle->getPluginName())[0];
                }

                return $bundle->getPluginName();
            }
        }

       return null;
    }
}