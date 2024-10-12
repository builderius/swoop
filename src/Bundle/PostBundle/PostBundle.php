<?php

namespace Swoop\Bundle\PostBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\PostBundle\PostStatus\Processor\PostStatusesProcessorInterface;
use Swoop\Bundle\PostBundle\PostStatus\Registry\PostStatusesRegistryInterface;
use Swoop\Bundle\PostBundle\PostType\Processor\PostTypesProcessorInterface;
use Swoop\Bundle\PostBundle\PostType\Registry\PostTypesRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PostBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_post_type',
                'swoop_post.registry.post_types',
                'addPostType'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_post_status',
                'swoop_post.registry.post_statuses',
                'addPostStatus'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var PostTypesRegistryInterface $postTypesRegistry */
        $postTypesRegistry = $this->container->get('swoop_post.registry.post_types');
        /** @var PostTypesProcessorInterface $postTypesProcessor */
        $postTypesProcessor = $this->container->get('swoop_post.processor.post_types');
        $postTypesProcessor->registerPostTypes($postTypesRegistry->getPostTypes());

        /** @var PostStatusesRegistryInterface $postStatusesRegistry */
        $postStatusesRegistry = $this->container->get('swoop_post.registry.post_statuses');
        /** @var PostStatusesProcessorInterface $postStatusesProcessor */
        $postStatusesProcessor = $this->container->get('swoop_post.processor.post_statuses');
        $postStatusesProcessor->registerPostStatuses($postStatusesRegistry->getPostStatuses());

        parent::boot();
    }
}
