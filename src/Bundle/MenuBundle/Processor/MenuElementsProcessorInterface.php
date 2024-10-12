<?php

namespace Swoop\Bundle\MenuBundle\Processor;

use Exception;
use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;

interface MenuElementsProcessorInterface
{
    /**
     * @param MenuElementInterface[] $menuElements
     * @throws Exception
     */
    public function register(array $menuElements);
}
