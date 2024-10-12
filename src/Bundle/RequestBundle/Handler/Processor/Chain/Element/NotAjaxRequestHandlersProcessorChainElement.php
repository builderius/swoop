<?php

namespace Swoop\Bundle\RequestBundle\Handler\Processor\Chain\Element;

use Swoop\Bundle\RequestBundle\Handler\RequestHandlerInterface;

class NotAjaxRequestHandlersProcessorChainElement extends AbstractRequestHandlersProcessorChainElement
{
    /**
     * @inheritDoc
     */
    public function isApplicable(RequestHandlerInterface $handler)
    {
        return !$handler->isAjax();
    }

    /**
     * @inheritDoc
     */
    public function register(RequestHandlerInterface $handler)
    {
        $actionName = $handler->getActionName();
        add_action(
            sprintf('admin_post_%s', $actionName),
            [$handler, 'handle']
        );
        if (!$handler->isPrivileged()) {
            add_action(
                sprintf('admin_post_nopriv_%s', $actionName),
                [$handler, 'handle']
            );
        }
        
        return null;
    }
}
