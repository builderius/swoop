<?php

namespace Swoop\Bundle\OptionBundle\Processor\Chain\Element;

use Swoop\Bundle\OptionBundle\Model\NonSiteOptionInterface;
use Swoop\Bundle\OptionBundle\Model\OptionInterface;

class NonSiteOptionsProcessorChainElement extends AbstractOptionsProcessorChainElement
{
    /**
     * @inheritDoc
     */
    public function isApplicable(OptionInterface $option)
    {
        return $option instanceof NonSiteOptionInterface;
    }

    /**
     * @inheritDoc
     */
    public function register(OptionInterface $option)
    {
        /** @var NonSiteOptionInterface $option */
        add_option(
            $option->getName(),
            $option->getValue(),
            $option->getDeprecated() ? : '',
            $option->isAutoload() ? : 'yes'
        );
    }
}
