<?php

namespace Swoop\Bundle\HookBundle\Model;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareTrait;
use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

abstract class AbstractHook extends ParameterBag implements HookInterface, ConditionAwareInterface
{
    const TAG_FIELD = 'tag';
    const PRIORITY_FIELD = 'priority';
    const ACCEPTED_ARGS_FIELD = 'accepted_args';
    const INIT_HOOK_NAME_FIELD = 'init_hook';
    const INIT_HOOK_PRIORITY_FIELD = 'init_hook_priority';

    use ConditionAwareTrait;

    public function getInitHookName(): ?string
    {
        return $this->get(self::INIT_HOOK_NAME_FIELD, 'init');
    }

    public function getInitHookPriority(): int
    {
        return $this->get(self::INIT_HOOK_PRIORITY_FIELD, 10);
    }

    public function getTag(): string
    {
        return $this->get(self::TAG_FIELD);
    }

    public function getAcceptedArgs(): int
    {
        return $this->get(self::ACCEPTED_ARGS_FIELD, 1);
    }

    public function getPriority(): int
    {
        return $this->get(self::PRIORITY_FIELD, 10);
    }
}
