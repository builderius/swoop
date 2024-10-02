<?php

namespace Swoop\Bundle\PageBundle\Model;

interface PageInterface
{
    /**
     * @return string
     */
    public function getSlug();

    /**
     * @return string
     */
    public function render();
}
