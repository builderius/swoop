<?php

namespace Swoop\Bundle\KernelBundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

abstract class Bundle implements BundleInterface
{
    use ContainerAwareTrait;

    protected string $name;
    protected ExtensionInterface $extension;
    protected string $path;
    private string $namespace;

    public function __construct(protected string $pluginName)
    {
    }

    public function boot(): void
    {
    }

    public function shutdown(): void
    {
    }

    public function build(ContainerBuilder $container): void
    {
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $extension = $this->createContainerExtension();
            if (null !== $extension) {
                if (!$extension instanceof ExtensionInterface) {
                    throw new \LogicException(
                        sprintf(
                            'Extension %s must implement 
                            Symfony\Component\DependencyInjection\Extension\ExtensionInterface.',
                            get_class($extension)
                        )
                    );
                }
                // check naming convention
                $basename = preg_replace('/Bundle$/', '', $this->getName());
                $expectedAlias = Container::underscore($basename);
                if ($expectedAlias != $extension->getAlias()) {
                    throw new \LogicException(
                        sprintf(
                            'Users will expect the alias of the default extension of a bundle to be the underscored
                             version of the bundle name ("%s"). You can override "Bundle::getContainerExtension()"
                              if you want to use "%s" or another alias.',
                            $expectedAlias, $extension->getAlias()
                        )
                    );
                }
                $this->extension = $extension;
            } else {
                $this->extension = false;
            }
        }
        if ($this->extension) {
            return $this->extension;
        }
        
        return null;
    }

    public function getNamespace(): string
    {
        if (null === $this->namespace) {
            $this->parseClassName();
        }
        return $this->namespace;
    }

    public function getPath(): string
    {
        if (null === $this->path) {
            $reflected = new \ReflectionObject($this);
            $this->path = dirname($reflected->getFileName());
        }
        return $this->path;
    }

    public function getPluginName(): string
    {
        return $this->pluginName;
    }

    final public function getName(): string
    {
        if (null === $this->name) {
            $this->parseClassName();
        }
        return $this->name;
    }

    /**
     * Returns the bundle's container extension class.
     */
    protected function getContainerExtensionClass(): string
    {
        $basename = preg_replace('/Bundle$/', '', $this->getName());
        return $this->getNamespace().'\\DependencyInjection\\'.$basename.'Extension';
    }
    
    /**
     * Creates the bundle's container extension.
     */
    protected function createContainerExtension(): ?ExtensionInterface
    {
        if (class_exists($class = $this->getContainerExtensionClass())) {
            return new $class();
        }
        
        return null;
    }
    
    private function parseClassName(): void
    {
        $pos = strrpos(static::class, '\\');
        $this->namespace = false === $pos ? '' : substr(static::class, 0, $pos);
        if (null === $this->name) {
            $this->name = false === $pos ? static::class : substr(static::class, $pos + 1);
        }
    }
}
