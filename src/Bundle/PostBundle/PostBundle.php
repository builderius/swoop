<?php

namespace Swoop\Bundle\PostBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\PostBundle\PostStatus\Registrator\PostStatusesRegistratorInterface;
use Swoop\Bundle\PostBundle\PostStatus\Registry\PostStatusesRegistryInterface;
use Swoop\Bundle\PostBundle\PostType\Registrator\PostTypesRegistratorInterface;
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
                'swoop_post_type',
                'swoop_post.registry.post_types',
                'addPostType'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_post_status',
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
        /** @var PostTypesRegistratorInterface $postTypesRegistrator */
        $postTypesRegistrator = $this->container->get('swoop_post.registrator.post_types');
        $postTypesRegistrator->registerPostTypes($postTypesRegistry->getPostTypes());

        /** @var PostStatusesRegistryInterface $postStatusesRegistry */
        $postStatusesRegistry = $this->container->get('swoop_post.registry.post_statuses');
        /** @var PostStatusesRegistratorInterface $postStatusesRegistrator */
        $postStatusesRegistrator = $this->container->get('swoop_post.registrator.post_statuses');
        $postStatusesRegistrator->registerPostStatuses($postStatusesRegistry->getPostStatuses());

        parent::boot();
    }
}
