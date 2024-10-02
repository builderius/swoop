<?php

namespace Swoop\Bundle\AssetBundle\Registrator\InlineAssets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsRegistratorChainElementInterface
{
    const ASSETS_TYPES = ['script', 'style'];

    /**
     * @param string $assetType
     * @return bool
     */
    public function isApplicable($assetType);

    /**
     * @param InlineAssetInterface $asset
     */
    public function enqueueDependency(InlineAssetInterface $asset);

    /**
     * @param InlineAssetInterface $asset
     */
    public function registerAsset(InlineAssetInterface $asset);
}
