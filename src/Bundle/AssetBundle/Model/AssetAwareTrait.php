<?php

namespace Swoop\Bundle\AssetBundle\Model;

trait AssetAwareTrait
{
    /**
     * @var AssetInterface[]
     */
    private array $assets = [];

    public function hasAssets(): bool
    {
        return !empty($this->assets);
    }

    /**
     * @return AssetInterface[]
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    public function addAsset(AssetInterface $asset): static
    {
        if (!in_array($asset, $this->assets)) {
            $this->assets[] = $asset;
        }

        return $this;
    }

    /**
     * @param AssetInterface[] $assets
     */
    public function setAssets(array $assets): static
    {
        $this->assets = $assets;

        return $this;
    }
}
