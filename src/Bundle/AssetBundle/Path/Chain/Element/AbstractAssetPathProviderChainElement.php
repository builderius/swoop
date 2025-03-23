<?php

namespace Swoop\Bundle\AssetBundle\Path\Chain\Element;

use Swoop\Bundle\AssetBundle\Path\AssetPathProviderInterface;

abstract class AbstractAssetPathProviderChainElement implements AssetPathProviderInterface
{
    private ?AssetPathProviderInterface $successor;

    public function setSuccessor(AssetPathProviderInterface $pathProvider): static
    {
        $this->successor = $pathProvider;

        return $this;
    }

    protected function getSuccessor(): ?AssetPathProviderInterface
    {
        return $this->successor;
    }
}
