<?php

namespace Swoop\Bundle\AssetBundle\Processor\Assets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsProcessorChainElementInterface
{
    /**
     * @param AssetInterface $asset
     * @return bool
     */
    public function isApplicable(AssetInterface $asset);

    /**
     * @param AssetInterface $asset
     */
    public function register(AssetInterface $asset);
}
