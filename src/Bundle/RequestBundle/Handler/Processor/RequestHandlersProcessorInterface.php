<?php

namespace Swoop\Bundle\RequestBundle\Handler\Processor;

use Swoop\Bundle\RequestBundle\Handler\RequestHandlerInterface;

interface RequestHandlersProcessorInterface
{
    /**
     * @param RequestHandlerInterface[] $handlers
     */
    public function registerRequestHandlers(array $handlers);
}
