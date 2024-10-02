<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsRegistryInterface
{
    /**
     * @param string $category
     * @return InlineAssetInterface[]
     */
    public function getAssets($category);
}
