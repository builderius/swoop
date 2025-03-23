<?php

namespace Swoop\Bundle\AssetBundle\Model;

trait InlineAssetAwareTrait
{
    /**
     * @var InlineAssetInterface[]
     */
    private array $inlineAssets = [];

    public function hasInlineAssets(): bool
    {
        return !empty($this->inlineAssets);
    }

    /**
     * @return InlineAssetInterface[]
     */
    public function getInlineAssets(): array
    {
        return $this->inlineAssets;
    }

    public function addInlineAsset(InlineAssetInterface $inlineAsset): static
    {
        if (!\in_array($inlineAsset, $this->inlineAssets)) {
            $this->inlineAssets[] = $inlineAsset;
        }
        return $this;
    }

    /**
     * @param InlineAssetInterface[] $inlineAssets
     */
    public function setInlineAssets(array $inlineAssets): static
    {
        $this->inlineAssets = $inlineAssets;
        return $this;
    }
}
