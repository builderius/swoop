<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

class InlineAssetsRegistry implements InlineAssetsRegistryInterface
{
    private array $assets = [];

    public function addAsset(InlineAssetInterface $asset): static
    {
        $this->assets[$asset->getCategory()][] = $asset;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getAssets(string $category): array
    {
        return $this->assets[$category] ?? [];
    }
}
