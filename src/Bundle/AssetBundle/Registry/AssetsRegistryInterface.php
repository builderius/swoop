<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsRegistryInterface
{
    /**
     * @return AssetInterface[]
     */
    public function getAssets(string $category): array;
}
