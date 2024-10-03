<?php

namespace Swoop\Bundle\ConditionBundle\DependencyInjection\CompilerPass;

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

            if (!empty($arguments) && isset($arguments[0]['name'])) {
                $aliasName = $arguments[0]['name'];
                $container->setAlias($aliasName, $condition)->setPublic(true);
            } else {
                $calls = $definition->getMethodCalls();
                foreach ($calls as $call) {
                    if ($call[0] === 'setName') {
                        $aliasName = $call[1][0];
                        $container->setAlias($aliasName, $condition)->setPublic(true);
                    }
                }
            }
        }
    }
}
