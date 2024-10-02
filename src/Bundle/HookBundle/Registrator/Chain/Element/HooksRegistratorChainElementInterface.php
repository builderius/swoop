<?php

namespace Swoop\Bundle\HookBundle\Registrator\Chain\Element;

use Swoop\Bundle\HookBundle\Model\HookInterface;

interface HooksRegistratorChainElementInterface
{
    /**
     * @param HookInterface $hook
     * @return bool
     */
    public function isApplicable(HookInterface $hook);

    /**
     * @param HookInterface $hook
     */
    public function register(HookInterface $hook);
}
