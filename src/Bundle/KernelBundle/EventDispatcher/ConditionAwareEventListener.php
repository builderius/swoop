<?php

namespace Swoop\Bundle\KernelBundle\EventDispatcher;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareTrait;

class ConditionAwareEventListener implements ConditionAwareInterface
{
    use ConditionAwareTrait;
}