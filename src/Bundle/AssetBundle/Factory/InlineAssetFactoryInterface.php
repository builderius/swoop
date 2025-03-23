<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionInterface;

interface InlineAssetFactoryInterface
{
    /**
     * @param array $arguments
     * @param ConditionInterface[] $conditions
     */
    public static function create(array $arguments, array $conditions = []): InlineAssetInterface;
}
