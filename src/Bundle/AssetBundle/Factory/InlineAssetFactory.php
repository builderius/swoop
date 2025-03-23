<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\InlineAsset;
use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

class InlineAssetFactory implements InlineAssetFactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function create(array $arguments, array $conditions = []): InlineAssetInterface
    {
        $script = new InlineAsset($arguments);
        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $script->addCondition($condition);
            }
        }

        return $script;
    }
}
