<?php

namespace Swoop\Bundle\AssetBundle;

use Swoop\Bundle\AssetBundle\DependencyInjection\CompilerPass\ScriptLocalizationsCompilerPass;
use Swoop\Bundle\AssetBundle\Model\AbstractAsset;
use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;
use Swoop\Bundle\AssetBundle\Processor\Assets\AssetsProcessorInterface;
use Swoop\Bundle\AssetBundle\Processor\InlineAssets\InlineAssetsProcessorInterface;
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
            /** @var AssetsProcessorInterface $adminAssetsProcessor */
            $adminAssetsProcessor = $this->container->get('swoop_asset.processor.admin');
            $adminAssetsProcessor->registerAssets($assetsRegistry->getAssets(AbstractAsset::ADMIN_CATEGORY));
            /** @var InlineAssetsProcessorInterface $adminInlineAssetsProcessor */
            $adminInlineAssetsProcessor = $this->container->get('swoop_asset.processor.inline_assets.admin');
            $adminInlineAssetsProcessor->registerAssets($inlineAssetsRegistry->getAssets(InlineAssetInterface::ADMIN_CATEGORY));
        } else {
            /** @var AssetsProcessorInterface $frontendAssetsProcessor */
            $frontendAssetsProcessor = $this->container->get('swoop_asset.processor.frontend');
            $frontendAssetsProcessor->registerAssets($assetsRegistry->getAssets(AbstractAsset::FRONTEND_CATEGORY));

            /** @var InlineAssetsProcessorInterface $frontendInlineAssetsProcessor */
            $frontendInlineAssetsProcessor = $this->container->get('swoop_asset.processor.inline_assets.frontend');
            $frontendInlineAssetsProcessor->registerAssets($inlineAssetsRegistry->getAssets(InlineAssetInterface::FRONTEND_CATEGORY));
        }
        parent::boot();
    }
}
