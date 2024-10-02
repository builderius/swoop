<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\ScriptLocalization;

class ScriptLocalizationFactory implements ScriptLocalizationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function create($objectName, $propertyName, $propertyData)
    {
        return new ScriptLocalization([
            ScriptLocalization::OBJECT_NAME_FIELD => $objectName,
            ScriptLocalization::PROPERTY_NAME_FIELD => $propertyName,
            ScriptLocalization::PROPERTY_DATA_FIELD => $propertyData
        ]);
    }
}
