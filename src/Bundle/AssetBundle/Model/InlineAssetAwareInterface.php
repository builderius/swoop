<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface InlineAssetAwareInterface
{
    public function hasInlineAssets(): bool;

    /**
     * @return InlineAssetInterface[]
     */
    public function getInlineAssets(): array;

    public function addInlineAsset(InlineAssetInterface $inlineAsset): static;

    /**
     * @param InlineAssetInterface[] $inlineAssets
     */
    public function setInlineAssets(array $inlineAssets): static;
}
