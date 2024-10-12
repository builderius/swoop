<?php

namespace Swoop\Bundle\MetaBoxBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MetaBoxBundle\Processor\MetaBoxesProcessorInterface;
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
                'wp_meta_box',
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
        /** @var MetaBoxesProcessorInterface $metaBoxesProcessor */
        $metaBoxesProcessor = $this->container->get('swoop_meta_box.processor.meta_boxes');
        $metaBoxesProcessor->registerMetaBoxes($metaBoxesRegistry->getMetaBoxes());
        
        parent::boot();
    }
}
