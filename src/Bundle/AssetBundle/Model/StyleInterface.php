<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface StyleInterface extends AssetInterface
{
    /**
     * @return string|null
     */
    public function getMedia();
}