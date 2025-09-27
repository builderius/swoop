<?php

namespace Swoop\Bundle\KernelBundle\Templating;

use Swoop\Bundle\KernelBundle\Kernel\Kernel;
class TemplateNameParser
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->kernel = $container->get('kernel');
    }
    
    /**
     * @inheritDoc
     */
    public function parse($name)
    {
        if (is_array($name)) {
            return $name;
        }

        $engine = null;
        if (false !== $pos = strrpos($name, '.')) {
            $engine = substr($name, $pos + 1);
        }

        $bundleName = null;
        if (false !== $pos = strrpos($name, ':')) {
            $bundleName = substr($name, 0, $pos);
            $name = substr($name, $pos + 1);
        }
        if ($bundleName) {
            if ($bundle = $this->kernel->getBundle($bundleName)) {
                $name = sprintf('%s/Resources/views/%s', $bundle->getPath(), $name);
            }
        }

        return [
            'name' => $name,
            'engine' => $engine,
            'logicalName' => $name
        ];
    }
}
