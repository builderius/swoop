<?php

namespace Swoop\Bundle\HookBundle\Model;

abstract class AbstractFilter extends AbstractHook implements FilterInterface
{
    const RETURN_ARGUMENT_ON_FAILED_CONDITIONS = 'return_argument_on_failed_conditions';

    public function getType(): string
    {
        return self::FILTER_TYPE;
    }

    public function returnOnFailedConditions(array $args): mixed
    {
        $number = $this->get(self::RETURN_ARGUMENT_ON_FAILED_CONDITIONS, 0);

        return $args[$number];
    }
}