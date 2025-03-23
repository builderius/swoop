<?php

namespace Swoop\Bundle\AssetBundle\Factory;

use Swoop\Bundle\AssetBundle\Model\ScriptLocalizationInterface;

interface ScriptLocalizationFactoryInterface
{
    public static function create(string $object, string $property, array $data): ScriptLocalizationInterface;
}
