<?php

namespace Swoop\Bundle\AssetBundle\Model;

use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

class AssetDataItem extends ParameterBag implements AssetDataItemInterface
{
    const KEY_FIELD = 'key';
    const VALUE_FIELD = 'value';
    const GROUP_FIELD = 'group';

    public function getKey(): string
    {
        return $this->get(self::KEY_FIELD);
    }

    public function getValue(): mixed
    {
        return $this->get(self::VALUE_FIELD);
    }

    public function getGroup(): string
    {
        return $this->get(self::GROUP_FIELD);
    }
}