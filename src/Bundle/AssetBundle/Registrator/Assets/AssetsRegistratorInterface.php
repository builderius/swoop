<?php

namespace Swoop\Bundle\AssetBundle\Registrator\Assets;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsRegistratorInterface
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
