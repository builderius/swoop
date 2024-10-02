<?php

namespace Swoop\Bundle\RequestBundle\Handler\Registrator;

use Swoop\Bundle\RequestBundle\Handler\RequestHandlerInterface;

interface RequestHandlersRegistratorInterface
{
    /**
     * @param RequestHandlerInterface[] $handlers
     */
    public function registerRequestHandlers(array $handlers);
}
