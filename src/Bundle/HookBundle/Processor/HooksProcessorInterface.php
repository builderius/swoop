<?php

namespace Swoop\Bundle\HookBundle\Processor;

use Swoop\Bundle\HookBundle\Model\HookInterface;

interface HooksProcessorInterface
{
    /**
     * @param HookInterface[] $hooks
     */
    public function registerHooks(array $hooks);
}
