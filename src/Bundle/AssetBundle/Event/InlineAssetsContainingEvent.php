<?php

namespace Swoop\Bundle\AssetBundle\Event;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;
use Symfony\Contracts\EventDispatcher\Event;

class InlineAssetsContainingEvent extends Event
{
    /**
     * @var InlineAssetInterface[]
     */
    private array $assets = [];

    /**
     * @param InlineAssetInterface[] $assets
     */
    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    /**
     * @return InlineAssetInterface[]
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    /**
     * @param InlineAssetInterface[] $assets
     */
    public function setAssets(array $assets): static
    {
        $this->assets = $assets;

        return $this;
    }
}