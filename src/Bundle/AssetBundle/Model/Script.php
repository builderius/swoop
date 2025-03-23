<?php

namespace Swoop\Bundle\AssetBundle\Model;

class Script extends AbstractAsset implements ScriptInterface
{
    const IN_FOOTER_FIELD = 'inFooter';
    const LOCALIZATIONS = 'localizations';

    public function isInFooter(): ?bool
    {
        return $this->get(self::IN_FOOTER_FIELD, false);
    }

    /**
     * @inheritDoc
     */
    public function getLocalizations(): array
    {
        $localizations = $this->get(self::LOCALIZATIONS, []);
        usort($localizations, function (ScriptLocalizationInterface $a, ScriptLocalizationInterface $b) {
            if ($a->getSortOrder() < $b->getSortOrder()) {
                return -1;
            } elseif ($a->getSortOrder() > $b->getSortOrder()) {
                return 1;
            } else {
                return 0;
            }
        });

        return $localizations;
    }

    public function addLocalization(ScriptLocalizationInterface $localization): static
    {
        $localizations = $this->getLocalizations();
        if (!in_array($localization, $localizations)) {
            $localizations[] = $localization;
            $this->set(self::LOCALIZATIONS, $localizations);
        }

        return $this;
    }
}