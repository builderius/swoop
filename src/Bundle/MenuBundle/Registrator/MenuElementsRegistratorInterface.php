<?php

namespace Swoop\Bundle\MenuBundle\Registrator;

use Exception;
use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;

interface MenuElementsRegistratorInterface
{
    /**
     * @param MenuElementInterface[] $menuElements
     * @throws Exception
     */
    public function register(array $menuElements);
}
