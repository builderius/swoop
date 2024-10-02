<?php

namespace Swoop\Bundle\WpCliBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\WpCliBundle\Registrator\WpCliCommandsRegistratorInterface;
use Swoop\Bundle\WpCliBundle\Registry\WpCliCommandsRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WpCliBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        /** @var ContainerBuilder $container */
        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_wpcli_command',
                'swoop_wpcli.registry.commands',
                'addCommand'
            )
        );
    }
    
    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var WpCliCommandsRegistryInterface $commandsRegistry */
        $commandsRegistry = $this->container->get('swoop_wpcli.registry.commands');
        /** @var WpCliCommandsRegistratorInterface $commandsRegistrator */
        $commandsRegistrator = $this->container->get('swoop_wpcli.registrator.commands');
        $commandsRegistrator->registerCommands($commandsRegistry->getCommands());

        parent::boot();
    }
}
