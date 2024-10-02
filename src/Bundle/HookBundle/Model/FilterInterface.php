<?php

namespace Swoop\Bundle\HookBundle\Model;

interface FilterInterface
{
    /**
     * @param array $args
     * @return mixed
     */
    public function returnOnFailedConditions(array $args);
}