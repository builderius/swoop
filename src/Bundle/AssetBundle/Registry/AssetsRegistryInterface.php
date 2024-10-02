<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsRegistryInterface
{
    /**
     * @param string $category
     * @return AssetInterface[]
     */
    public function getAssets($category);
}
