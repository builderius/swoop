<?php

namespace Swoop\Bundle\AssetBundle\Processor\Assets;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsProcessorInterface
{
    /**
     * @param AssetInterface[] $assets
     * @return mixed
     */
    public function registerAssets(array $assets);

    /**
     * @param AssetInterface $asset
     */
    public function registerAsset(AssetInterface $asset);
}
