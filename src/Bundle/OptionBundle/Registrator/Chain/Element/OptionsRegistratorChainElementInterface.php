<?php

namespace Swoop\Bundle\OptionBundle\Registrator\Chain\Element;

use Swoop\Bundle\OptionBundle\Model\OptionInterface;

interface OptionsRegistratorChainElementInterface
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
