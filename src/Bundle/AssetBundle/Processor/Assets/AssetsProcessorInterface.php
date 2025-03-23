<?php

namespace Swoop\Bundle\AssetBundle\Processor\Assets;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsProcessorInterface
{
    /**
     * @param AssetInterface[] $assets
     */
    public function registerAssets(array $assets): void;

    public function registerAsset(AssetInterface $asset): void;
}
