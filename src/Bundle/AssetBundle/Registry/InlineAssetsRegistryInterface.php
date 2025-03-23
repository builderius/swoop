<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsRegistryInterface
{
    /**
     * @return InlineAssetInterface[]
     */
    public function getAssets(string $category): array;
}
