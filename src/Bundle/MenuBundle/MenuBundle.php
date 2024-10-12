<?php

namespace Swoop\Bundle\MenuBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MenuBundle\Processor\MenuElementsProcessorInterface;
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
                'wp_admin_menu_page',
                'swoop_menu.registry.admin_menu_pages',
                'addMenuElement'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_admin_bar_node',
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
            /** @var MenuElementsProcessorInterface $adminMenuPagesProcessor */
            $adminMenuPagesProcessor = $this->container->get('swoop_menu.processor.admin_menu_pages');
            $adminMenuPagesProcessor->register($adminMenuPagesRegistry->getMenuElements());
        }
        /** @var MenuElementsRegistryInterface $adminBarNodesRegistry */
        $adminBarNodesRegistry = $this->container->get('swoop_menu.registry.admin_bar_nodes');
        /** @var MenuElementsProcessorInterface $adminMenuPagesProcessor */
        $adminBarNodesProcessor = $this->container->get('swoop_menu.processor.admin_bar_nodes');
        $adminBarNodesProcessor->register($adminBarNodesRegistry->getMenuElements());

        parent::boot();
    }
}
