<?php

namespace Swoop\Bundle\AssetBundle\Registrator\InlineAssets;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsRegistratorInterface
{
    /**
     * @param InlineAssetInterface[] $assets
     */
    public function registerAssets(array $assets);
}
