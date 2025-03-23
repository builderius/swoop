<?php

namespace Swoop\Bundle\AssetBundle\Event;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;
use Symfony\Contracts\EventDispatcher\Event;

class AssetsContainingEvent extends Event
{
    /**
     * @var AssetInterface[]
     */
    private array $assets = [];

    /**
     * @param AssetInterface[] $assets
     */
    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    /**
     * @return AssetInterface[]
     */
    public function getAssets(): array
    {
        return $this->assets;
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