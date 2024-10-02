<?php

namespace Swoop\Bundle\AssetBundle\Path\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

class AbsoluteAssetPathProvider extends AbstractAssetPathProviderChainElement
{
    /**
     * @inheritDoc
     */
    public function getAssetPath(AssetInterface $asset)
    {
        if ($asset->getSource()) {
            return $asset->getSource();
        } elseif ($this->getSuccessor()) {
            return $this->getSuccessor()->getAssetPath($asset);
        }

        return null;
    }
}
