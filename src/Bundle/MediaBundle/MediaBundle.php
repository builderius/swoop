<?php

namespace Swoop\Bundle\MediaBundle;

use Swoop\Bundle\HookBundle\Processor\HooksProcessorInterface;
use Swoop\Bundle\HookBundle\Registry\HooksRegistryInterface;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MediaBundle\Processor\ImageSizesProcessorInterface;
use Swoop\Bundle\MediaBundle\Processor\MimeTypesProcessorInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MediaBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_image_size',
                'swoop_media.processor.image_sizes',
                'addImageSize'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_mime_type',
                'swoop_media.processor.mime_types',
                'addMimeType'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var ImageSizesProcessorInterface $imageSizesProcessor */
        $imageSizesProcessor = $this->container->get('swoop_media.processor.image_sizes');
        $imageSizesProcessor->registerImageSizes();

        /** @var MimeTypesProcessorInterface $mimeTypesProcessor */
        $mimeTypesProcessor = $this->container->get('swoop_media.processor.mime_types');
        $mimeTypesProcessor->registerMimeTypes();
        
        parent::boot();
    }
}
