<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\InlineAsset;

class InlineAssetFactory implements InlineAssetFactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function create(array $arguments, array $conditions = [])
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
