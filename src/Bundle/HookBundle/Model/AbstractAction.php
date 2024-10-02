<?php

namespace Swoop\Bundle\HookBundle\Model;

abstract class AbstractAction extends AbstractHook
{
    /**
     * @inheritDoc
     */
    public function getType()
    {
        return self::ACTION_TYPE;
    }
}