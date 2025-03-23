<?php

namespace Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class KernelCompilerPass implements CompilerPassInterface
{
    /**
     * @throws \Exception
     */
    public function __construct(private string $tag, private string $service, private string $method)
    {
        if (!$tag || !$service || !$method) {
            throw new \Exception('missing parameter');
        }
    }

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition($this->service)) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds($this->tag);
        if (!$taggedServices) {
            return;
        }

        $elements = new \SplPriorityQueue();

        $definition = $container->getDefinition($this->service);
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $tag) {
                $priority = 0;
                if (array_key_exists('priority', $tag)) {
                    $priority = $tag['priority'];
                }
                $elements->insert(new Reference($id), $priority);
            }
        }

        foreach ($elements as $element) {
            $definition->addMethodCall($this->method, [$element]);
        }
    }
}
