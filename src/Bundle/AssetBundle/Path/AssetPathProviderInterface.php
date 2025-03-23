<?php

namespace Swoop\Bundle\AssetBundle\Path;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;

interface AssetPathProviderInterface
{
    public function getAssetPath(AssetInterface $asset): ?string;
}
