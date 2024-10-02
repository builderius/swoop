<?php

namespace Swoop\Bundle\ConditionBundle\Registry;

use Swoop\Bundle\ConditionBundle\Model\ConditionInterface;

interface ConditionsRegistryInterface
{
    /**
     * @return ConditionInterface[]
     */
    public function getConditions();

    /**
     * @param string $name
     * @return ConditionInterface
     */
    public function getCondition($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasCondition($name);
}
