<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface ScriptLocalizationInterface
{
    public function getObjectName(): string;

    public function getPropertyName(): string;

    public function getPropertyData(): mixed;

    public function getSortOrder(): int;
}
