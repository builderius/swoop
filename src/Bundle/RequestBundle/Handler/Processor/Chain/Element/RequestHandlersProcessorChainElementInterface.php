<?php

namespace Swoop\Bundle\RequestBundle\Handler\Processor\Chain\Element;

use Swoop\Bundle\RequestBundle\Handler\RequestHandlerInterface;

interface RequestHandlersProcessorChainElementInterface
{
    /**
     * @param RequestHandlerInterface $handler
     * @return bool
     */
    public function isApplicable(RequestHandlerInterface $handler);

    /**
     * @param RequestHandlerInterface $handler
     */
    public function register(RequestHandlerInterface $handler);
}
