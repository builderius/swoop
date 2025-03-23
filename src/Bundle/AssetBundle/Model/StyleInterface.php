<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface StyleInterface extends AssetInterface
{
    public function getMedia(): ?string;
}