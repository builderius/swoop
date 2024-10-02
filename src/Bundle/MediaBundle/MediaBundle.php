<?php

namespace Swoop\Bundle\MediaBundle;

use Swoop\Bundle\HookBundle\Registrator\HooksRegistratorInterface;
use Swoop\Bundle\HookBundle\Registry\HooksRegistryInterface;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\MediaBundle\Registrator\ImageSizesRegistratorInterface;
use Swoop\Bundle\MediaBundle\Registrator\MimeTypesRegistratorInterface;
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
                'swoop_image_size',
                'swoop_media.registrator.image_sizes',
                'addImageSize'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_mime_type',
                'swoop_media.registrator.mime_types',
                'addMimeType'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var ImageSizesRegistratorInterface $imageSizesRegistrator */
        $imageSizesRegistrator = $this->container->get('swoop_media.registrator.image_sizes');
        $imageSizesRegistrator->registerImageSizes();

        /** @var MimeTypesRegistratorInterface $mimeTypesRegistrator */
        $mimeTypesRegistrator = $this->container->get('swoop_media.registrator.mime_types');
        $mimeTypesRegistrator->registerMimeTypes();
        
        parent::boot();
    }
}
