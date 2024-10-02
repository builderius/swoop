<?php

namespace Swoop\Bundle\MenuBundle\Model;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;

interface MenuElementInterface extends ConditionAwareInterface
{
    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getParent();
}
