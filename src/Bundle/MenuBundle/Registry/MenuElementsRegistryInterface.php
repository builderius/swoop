<?php

namespace Swoop\Bundle\MenuBundle\Registry;

use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;

interface MenuElementsRegistryInterface
{
    /**
     * @return MenuElementInterface[]
     */
    public function getMenuElements();

    /**
     * @param string $identifier
     * @return MenuElementInterface
     */
    public function getMenuElement($identifier);

    /**
     * @param string $identifier
     * @return bool
     */
    public function hasMenuElement($identifier);
}
