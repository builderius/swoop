<?php

namespace Swoop\Bundle\AssetBundle\Processor\Assets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetsProcessorChainElementInterface
{
    public function isApplicable(AssetInterface $asset): bool;

    public function register(AssetInterface $asset);
}
