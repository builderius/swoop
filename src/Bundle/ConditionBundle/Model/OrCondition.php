<?php

namespace Builderius\Swoop\Bundle\ConditionBundle\Model;

class OrCondition extends AbstractCondition
{
    /**
     * @var ConditionInterface[]
     */
    private $conditions = [];

    /**
     * @param ConditionInterface $condition
     * @return $this
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function getResult()
    {
        foreach ($this->conditions as $condition) {
            if ($condition->evaluate() === true) {
                return true;
            }
        }

        return false;
    }
}