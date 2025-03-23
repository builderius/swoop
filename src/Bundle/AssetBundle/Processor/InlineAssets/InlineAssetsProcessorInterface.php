<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

interface InlineAssetsProcessorInterface
{
    /**
     * @param InlineAssetInterface[] $assets
     */
    public function registerAssets(array $assets): void;
}
