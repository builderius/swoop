<?php

namespace Swoop\Bundle\HookBundle;

use Swoop\Bundle\HookBundle\Registrator\HooksRegistratorInterface;
use Swoop\Bundle\HookBundle\Registry\HooksRegistryInterface;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HookBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_hook',
                'swoop_hook.registry.hooks',
                'addHook'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var HooksRegistryInterface $hooksRegistry */
        $hooksRegistry = $this->container->get('swoop_hook.registry.hooks');
        /** @var HooksRegistratorInterface $hooksRegistrator */
        $hooksRegistrator = $this->container->get('swoop_hook.hooks_registrator.main');
        $hooksRegistrator->registerHooks($hooksRegistry->getHooks());

        parent::boot();
    }
}
