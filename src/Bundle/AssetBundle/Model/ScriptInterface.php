<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface ScriptInterface extends AssetInterface
{
    public function isInFooter(): ?bool;

    /**
     * @return ScriptLocalizationInterface[]
     */
    public function getLocalizations(): array;

    public function addLocalization(ScriptLocalizationInterface $localization): static;
}