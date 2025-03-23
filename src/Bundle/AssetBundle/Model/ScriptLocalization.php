<?php

namespace Swoop\Bundle\AssetBundle\Model;

use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

class ScriptLocalization extends ParameterBag implements ScriptLocalizationInterface
{
    const OBJECT_NAME_FIELD = 'object_name';
    const PROPERTY_NAME_FIELD = 'property_name';
    const PROPERTY_DATA_FIELD = 'property_data';
    const SORT_ORDER_FIELD = 'sort_order';

    public function getObjectName(): string
    {
        return $this->get(self::OBJECT_NAME_FIELD);
    }

    public function getPropertyName(): string
    {
        return $this->get(self::PROPERTY_NAME_FIELD);
    }

    public function getPropertyData(): mixed
    {
        return $this->get(self::PROPERTY_DATA_FIELD);
    }


    public function getSortOrder(): int
    {
        return $this->get(self::SORT_ORDER_FIELD);
    }
}
