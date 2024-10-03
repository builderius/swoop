<?php

namespace Swoop\Bundle\AssetBundle;

use Swoop\Bundle\AssetBundle\DependencyInjection\CompilerPass\ScriptLocalizationsCompilerPass;
use Swoop\Bundle\AssetBundle\Model\AbstractAsset;
use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;
use Swoop\Bundle\AssetBundle\Registrator\Assets\AssetsRegistratorInterface;
use Swoop\Bundle\AssetBundle\Registrator\InlineAssets\InlineAssetsRegistratorInterface;
use Swoop\Bundle\AssetBundle\Registry\AssetsRegistryInterface;
use Swoop\Bundle\AssetBundle\Registry\InlineAssetsRegistryInterface;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AssetBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);


        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_inline_asset',
                'swoop_asset.registry.inline_assets',
                'addAsset'
            )
        );

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_asset',
                'swoop_asset.registry.assets',
                'addAsset'
            )
        );
        $container->addCompilerPass(
            new ScriptLocalizationsCompilerPass()
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var AssetsRegistryInterface $assetsRegistry */
        $assetsRegistry = $this->container->get('swoop_asset.registry.assets');
        /** @var InlineAssetsRegistryInterface $inlineAssetsRegistry */
        $inlineAssetsRegistry = $this->container->get('swoop_asset.registry.inline_assets');
        if (is_admin()) {
            /** @var AssetsRegistratorInterface $adminAssetsRegistrator */
            $adminAssetsRegistrator = $this->container->get('swoop_asset.registrator.admin');
            $adminAssetsRegistrator->registerAssets($assetsRegistry->getAssets(AbstractAsset::ADMIN_CATEGORY));
            /** @var InlineAssetsRegistratorInterface $adminInlineAssetsRegistrator */
            $adminInlineAssetsRegistrator = $this->container->get('swoop_asset.registrator.inline_assets.admin');
            $adminInlineAssetsRegistrator->registerAssets($inlineAssetsRegistry->getAssets(InlineAssetInterface::ADMIN_CATEGORY));
        } else {
            /** @var AssetsRegistratorInterface $frontendAssetsRegistrator */
            $frontendAssetsRegistrator = $this->container->get('swoop_asset.registrator.frontend');
            $frontendAssetsRegistrator->registerAssets($assetsRegistry->getAssets(AbstractAsset::FRONTEND_CATEGORY));

            /** @var InlineAssetsRegistratorInterface $frontendInlineAssetsRegistrator */
            $frontendInlineAssetsRegistrator = $this->container->get('swoop_asset.registrator.inline_assets.frontend');
            $frontendInlineAssetsRegistrator->registerAssets($inlineAssetsRegistry->getAssets(InlineAssetInterface::FRONTEND_CATEGORY));
        }
        parent::boot();
    }
}
