<?php

namespace Swoop\Bundle\HookBundle\Model;

interface FilterInterface
{
    public function returnOnFailedConditions(array $args): mixed;
}