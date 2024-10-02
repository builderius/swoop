<?php

namespace Swoop\Bundle\AssetBundle\Model;

class Style extends AbstractAsset implements StyleInterface
{
    const MEDIA_FIELD = 'media';

    /**
     * @inheritDoc
     */
    public function getMedia()
    {
        return $this->get(self::MEDIA_FIELD, 'all');
    }
}