<?php

namespace Swoop\Bundle\HookBundle\Registry;

use Swoop\Bundle\HookBundle\Model\HookInterface;

class HooksRegistry implements HooksRegistryInterface
{
    /**
     * @var HookInterface[]
     */
    private $hooks = [];

    /**
     * @param HookInterface $hook
     */
    public function addHook(HookInterface $hook)
    {
        $this->hooks[] = $hook;
    }

    /**
     * @inheritDoc
     */
    public function getHooks()
    {
        return $this->hooks;
    }
}
