<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface AssetDataItemInterface
{
    public function getKey(): string;
    public function getValue(): mixed;
    public function getGroup(): string;
}