<?php

namespace Swoop\Bundle\ConditionBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConditionsNamesServicesCompilerPass implements CompilerPassInterface
{
    const CONDITION_TAG = 'wp_condition';

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $conditions = $container->findTaggedServiceIds(self::CONDITION_TAG);
        if (!$conditions) {
            return;
        }
        foreach ($conditions as $condition => $attributes) {
            $definition = $container->getDefinition($condition);
            $arguments = $definition->getArguments();
            if (!empty($arguments)) {
                $newDef = new ChildDefinition($condition);
                $container->setDefinition($arguments[0]['name'], $newDef);
            } else {
                $calls = $definition->getMethodCalls();
                foreach ($calls as $call) {
                    if ($call[0] === 'setName') {
                        $newDef = new ChildDefinition($condition);
                        $container->setDefinition($call[1][0], $newDef);
                    }
                }
            }
        }
    }
}
