<?php

namespace Swoop\Bundle\MenuBundle\Registry;

use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuElementsRegistry implements MenuElementsRegistryInterface
{
    /**
     * @var MenuElementInterface[]
     */
    private $menuElements = [];

    /**
     * @param MenuElementInterface $menuElement
     */
    public function addMenuElement(MenuElementInterface $menuElement)
    {
        $this->menuElements[] = $menuElement;
    }

    /**
     * @inheritDoc
     */
    public function getMenuElements()
    {
        usort($this->menuElements, function (MenuElementInterface $a, MenuElementInterface $b) {
            if ((!$a->getParent() && $b->getParent()) || ($a->getIdentifier() === $b->getParent())) {
                return -1;
            } elseif (($a->getParent() && !$b->getParent()) || ($b->getIdentifier() === $a->getParent())) {
                return 1;
            } else {
                return 0;
            }
        });
        return $this->menuElements;
    }

    /**
     * @inheritDoc
     */
    public function getMenuElement($identifier)
    {
        if ($this->hasMenuElement($identifier)) {
            return $this->menuElements[$identifier];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasMenuElement($identifier)
    {
        return isset($this->menuElements[$identifier]);
    }
}
