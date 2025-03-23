<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\ScriptLocalization;
use Swoop\Bundle\AssetBundle\Model\ScriptLocalizationInterface;

class ScriptLocalizationFactory implements ScriptLocalizationFactoryInterface
{
    public static function create(string $object, string $property, array $data): ScriptLocalizationInterface
    {
        return new ScriptLocalization([
            ScriptLocalization::OBJECT_NAME_FIELD => $object,
            ScriptLocalization::PROPERTY_NAME_FIELD => $property,
            ScriptLocalization::PROPERTY_DATA_FIELD => $data
        ]);
    }
}
