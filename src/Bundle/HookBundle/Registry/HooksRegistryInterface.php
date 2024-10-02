<?php

namespace Swoop\Bundle\HookBundle\Registry;

use Swoop\Bundle\HookBundle\Model\HookInterface;

interface HooksRegistryInterface
{
    /**
     * @return HookInterface[]
     */
    public function getHooks();
}
