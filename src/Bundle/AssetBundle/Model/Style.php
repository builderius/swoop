<?php

namespace Swoop\Bundle\AssetBundle\Model;

class Style extends AbstractAsset implements StyleInterface
{
    const MEDIA_FIELD = 'media';

    public function getMedia(): ?string
    {
        return $this->get(self::MEDIA_FIELD, 'all');
    }
}