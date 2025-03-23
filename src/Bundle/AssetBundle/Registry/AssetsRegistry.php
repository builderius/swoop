<?php

namespace Swoop\Bundle\AssetBundle\Registry;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

class AssetsRegistry implements AssetsRegistryInterface
{
    private array $assets = [];

    public function addAsset(AssetInterface $asset): static
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
