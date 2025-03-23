<?php

namespace Swoop\Bundle\HookBundle\Model;

interface HookInterface
{
    const ACTION_TYPE = 'action';
    const FILTER_TYPE = 'filter';

    public function getInitHookName(): ?string;
    public function getInitHookPriority(): int;
    public function getType(): string;
    public function getTag(): string;
    public function getPriority(): int;
    public function getAcceptedArgs(): int;
    public function getFunction(...$args): mixed;
}
