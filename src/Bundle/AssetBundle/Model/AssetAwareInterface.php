<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface AssetAwareInterface
{
    public function hasAssets(): bool;

    /**
     * @return AssetInterface[]
     */
    public function getAssets(): array;

    public function addAsset(AssetInterface $asset): static;

    /**
     * @param AssetInterface[] $assets
     */
    public function setAssets(array $assets): static;
}
