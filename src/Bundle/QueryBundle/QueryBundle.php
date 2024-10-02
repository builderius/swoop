<?php

namespace Swoop\Bundle\QueryBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\QueryBundle\DependencyInjection\CompilerPass\QueryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class QueryBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new QueryCompilerPass());
    }
}
