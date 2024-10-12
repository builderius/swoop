<?php

namespace Swoop\Bundle\OptionBundle\Processor\Chain\Element;

use Swoop\Bundle\OptionBundle\Model\OptionInterface;

interface OptionsProcessorChainElementInterface
{
    /**
     * @param OptionInterface $option
     * @return bool
     */
    public function isApplicable(OptionInterface $option);

    /**
     * @param OptionInterface $option
     */
    public function register(OptionInterface $option);
}
