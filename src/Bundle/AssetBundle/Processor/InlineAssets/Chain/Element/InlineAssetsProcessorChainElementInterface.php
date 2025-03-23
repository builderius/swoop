<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsProcessorChainElementInterface
{
    const ASSETS_TYPES = ['script', 'style'];

    public function isApplicable(string $assetType): bool;

    public function enqueueDependency(InlineAssetInterface $asset): void;

    public function registerAsset(InlineAssetInterface $asset): void;
}
