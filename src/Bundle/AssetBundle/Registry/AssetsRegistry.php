<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

class AssetsRegistry implements AssetsRegistryInterface
{
    /**
     * @var AssetInterface[]
     */
    private $assets = [];

    /**
     * @param AssetInterface $asset
     */
    public function addAsset(AssetInterface $asset)
    {
        $this->assets[$asset->getCategory()][] = $asset;
    }

    /**
     * @inheritDoc
     */
    public function getAssets($category)
    {
        return isset($this->assets[$category]) ? $this->assets[$category] : [];
    }
}
