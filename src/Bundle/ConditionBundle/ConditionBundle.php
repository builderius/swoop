<?php

namespace Swoop\Bundle\ConditionBundle;

use Swoop\Bundle\ConditionBundle\DependencyInjection\CompilerPass\ConditionsNamesServicesCompilerPass;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConditionBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_condition',
                'swoop_condition.registry.conditions',
                'addCondition'
            )
        );
        $container->addCompilerPass(new ConditionsNamesServicesCompilerPass());
    }
}
