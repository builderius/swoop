<?php

namespace Swoop\Bundle\OptionBundle\Processor\Chain\Element;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\OptionBundle\Model\OptionInterface;
use Swoop\Bundle\OptionBundle\Processor\OptionsProcessorInterface;

abstract class AbstractOptionsProcessorChainElement implements
    OptionsProcessorInterface,
    OptionsProcessorChainElementInterface
{
    /**
     * @var OptionInterface[]
     */
    private $options = [];

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option)
    {
        $this->options[$option->getName()] = $option;

        return $this;
    }

    /**
     * @var OptionsProcessorChainElementInterface|null
     */
    private $successor;

    /**
     * @inheritDoc
     */
    public function registerOptions()
    {
        $options = $this->options;
        add_action('init', function () use ($options) {
            /** @var OptionInterface $option */
            foreach ($options as $option) {
                if ($option instanceof ConditionAwareInterface && $option->hasConditions()) {
                    $evaluated = true;
                    foreach ($option->getConditions() as $condition) {
                        if ($condition->evaluate() === false) {
                            $evaluated = false;
                            break;
                        }
                    }
                    if (!$evaluated) {
                        continue;
                    }
                    $this->registerOption($option);
                } else {
                    $this->registerOption($option);
                }
            }
        });
    }

    /**
     * @param OptionInterface $option
     */
    private function registerOption(OptionInterface $option)
    {
        if ($this->isApplicable($option)) {
            $this->register($option);
        } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($option)) {
            $this->getSuccessor()->register($option);
        }
    }
    
    /**
     * @param OptionsProcessorChainElementInterface $optionProcessor
     */
    public function setSuccessor(OptionsProcessorChainElementInterface $optionProcessor)
    {
        $this->successor = $optionProcessor;
    }

    /**
     * @return OptionsProcessorChainElementInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}
