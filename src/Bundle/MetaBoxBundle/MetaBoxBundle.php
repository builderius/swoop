<?php

namespace Swoop\Bundle\MetaBoxBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MetaBoxBundle\Registrator\MetaBoxesRegistratorInterface;
use Swoop\Bundle\MetaBoxBundle\Registry\MetaBoxesRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MetaBoxBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_meta_box',
                'swoop_meta_box.registry.meta_boxes',
                'addMetaBox'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var MetaBoxesRegistryInterface $metaBoxesRegistry */
        $metaBoxesRegistry = $this->container->get('swoop_meta_box.registry.meta_boxes');
        /** @var MetaBoxesRegistratorInterface $metaBoxesRegistrator */
        $metaBoxesRegistrator = $this->container->get('swoop_meta_box.registrator.meta_boxes');
        $metaBoxesRegistrator->registerMetaBoxes($metaBoxesRegistry->getMetaBoxes());
        
        parent::boot();
    }
}
