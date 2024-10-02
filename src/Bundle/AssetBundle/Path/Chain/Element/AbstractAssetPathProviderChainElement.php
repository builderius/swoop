<?php

namespace Swoop\Bundle\AssetBundle\Path\Chain\Element;

use Swoop\Bundle\AssetBundle\Path\AssetPathProviderInterface;

abstract class AbstractAssetPathProviderChainElement implements AssetPathProviderInterface
{
    /**
     * @var AssetPathProviderInterface|null
     */
    private $successor;

    /**
     * @param AssetPathProviderInterface $pathProvider
     */
    public function setSuccessor(AssetPathProviderInterface $pathProvider)
    {
        $this->successor = $pathProvider;
    }

    /**
     * @return AssetPathProviderInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}
