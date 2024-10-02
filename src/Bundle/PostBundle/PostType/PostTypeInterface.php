<?php

namespace Swoop\Bundle\PostBundle\PostType;

interface PostTypeInterface
{
    /**
     * @return string
     */
    public function getType();

    /**
     * @return array
     */
    public function getArguments();
}
