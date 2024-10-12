<?php

namespace Swoop\Bundle\HookBundle\Processor\Chain\Element;

use Swoop\Bundle\HookBundle\Model\HookInterface;

interface HooksProcessorChainElementInterface
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
