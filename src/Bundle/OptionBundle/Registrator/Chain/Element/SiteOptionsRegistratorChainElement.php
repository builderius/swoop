<?php

namespace Swoop\Bundle\OptionBundle\Registrator\Chain\Element;

use Swoop\Bundle\OptionBundle\Model\OptionInterface;
use Swoop\Bundle\OptionBundle\Model\SiteOptionInterface;

class SiteOptionsRegistratorChainElement extends AbstractOptionsRegistratorChainElement
{
    /**
     * @inheritDoc
     */
    public function isApplicable(OptionInterface $option)
    {
        return $option instanceof SiteOptionInterface;
    }

    /**
     * @inheritDoc
     */
    public function register(OptionInterface $option)
    {
        /** @var SiteOptionInterface $option */
        add_site_option(
            $option->getName(),
            $option->getValue()
        );
    }
}
