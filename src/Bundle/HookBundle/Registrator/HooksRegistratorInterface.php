<?php

namespace Swoop\Bundle\HookBundle\Registrator;

use Swoop\Bundle\HookBundle\Model\HookInterface;

interface HooksRegistratorInterface
{
    /**
     * @param HookInterface[] $hooks
     */
    public function registerHooks(array $hooks);
}
