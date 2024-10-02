<?php

namespace Swoop\Bundle\RequestBundle\Registry;

use Swoop\Bundle\RequestBundle\Handler\RequestHandlerInterface;

interface RequestHandlersRegistryInterface
{
    /**
     * @return RequestHandlerInterface[]
     */
    public function getHandlers();

    /**
     * @param string $actionName
     * @return RequestHandlerInterface
     */
    public function getHandler($actionName);

    /**
     * @param string $actionName
     * @return bool
     */
    public function hasHandler($actionName);
}
