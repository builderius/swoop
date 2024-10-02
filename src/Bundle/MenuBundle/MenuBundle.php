<?php

namespace Swoop\Bundle\MenuBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MenuBundle\Registrator\MenuElementsRegistratorInterface;
use Swoop\Bundle\MenuBundle\Registry\MenuElementsRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MenuBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_admin_menu_page',
                'swoop_menu.registry.admin_menu_pages',
                'addMenuElement'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_admin_bar_node',
                'swoop_menu.registry.admin_bar_nodes',
                'addMenuElement'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        if (is_admin()) {
            /** @var MenuElementsRegistryInterface $adminMenuPagesRegistry */
            $adminMenuPagesRegistry = $this->container->get('swoop_menu.registry.admin_menu_pages');
            /** @var MenuElementsRegistratorInterface $adminMenuPagesRegistrator */
            $adminMenuPagesRegistrator = $this->container->get('swoop_menu.registrator.admin_menu_pages');
            $adminMenuPagesRegistrator->register($adminMenuPagesRegistry->getMenuElements());
        }
        /** @var MenuElementsRegistryInterface $adminBarNodesRegistry */
        $adminBarNodesRegistry = $this->container->get('swoop_menu.registry.admin_bar_nodes');
        /** @var MenuElementsRegistratorInterface $adminMenuPagesRegistrator */
        $adminBarNodesRegistrator = $this->container->get('swoop_menu.registrator.admin_bar_nodes');
        $adminBarNodesRegistrator->register($adminBarNodesRegistry->getMenuElements());

        parent::boot();
    }
}
