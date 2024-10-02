<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface AssetDataItemInterface
{
    /**
     * @return string
     */
    public function getKey();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getGroup();
}