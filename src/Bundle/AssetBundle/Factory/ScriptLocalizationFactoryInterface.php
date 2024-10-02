<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\ScriptLocalizationInterface;

interface ScriptLocalizationFactoryInterface
{
    /**
     * @param string $object
     * @param string $property
     * @param array $data
     * @return ScriptLocalizationInterface
     */
    public static function create($object, $property, $data);
}
