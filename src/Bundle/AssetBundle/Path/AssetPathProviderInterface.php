<?php

namespace Swoop\Bundle\AssetBundle\Path;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetPathProviderInterface
{
    /**
     * @param AssetInterface $asset
     * @return string|null
     */
    public function getAssetPath(AssetInterface $asset);
}
