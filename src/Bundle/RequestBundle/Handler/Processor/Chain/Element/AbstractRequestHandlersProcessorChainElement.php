<?php

namespace Swoop\Bundle\RequestBundle\Handler\Processor\Chain\Element;

use Swoop\Bundle\RequestBundle\Handler\Processor\RequestHandlersProcessorInterface;

abstract class AbstractRequestHandlersProcessorChainElement implements
    RequestHandlersProcessorInterface,
    RequestHandlersProcessorChainElementInterface
{
    /**
     * @var RequestHandlersProcessorChainElementInterface|null
     */
    private $successor;

    /**
     * @inheritDoc
     */
    public function registerRequestHandlers(array $handlers)
    {
        foreach ($handlers as $handler) {
            if ($this->isApplicable($handler)) {
                $this->register($handler);
            } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($handler)) {
                $this->getSuccessor()->register($handler);
            } else {
                continue;
            }
        }
    }

    /**
     * @param RequestHandlersProcessorChainElementInterface $handlerProcessor
     */
    public function setSuccessor(RequestHandlersProcessorChainElementInterface $handlerProcessor)
    {
        $this->successor = $handlerProcessor;
    }

    /**
     * @return RequestHandlersProcessorChainElementInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}
