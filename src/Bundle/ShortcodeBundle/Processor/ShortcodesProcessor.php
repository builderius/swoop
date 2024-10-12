<?php

namespace Swoop\Bundle\ShortcodeBundle\Processor;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ShortcodeBundle\Model\ShortcodeInterface;

class ShortcodesProcessor implements ShortcodesProcessorInterface
{
    /**
     * @var ShortcodeInterface[]
     */
    private $shortcodes = [];

    /**
     * @param ShortcodeInterface $shortcode
     * @return $this
     */
    public function addShortcode(ShortcodeInterface $shortcode)
    {
        $this->shortcodes[$shortcode->getTag()] = $shortcode;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerShortcodes()
    {
        $shortcodes = $this->shortcodes;
        add_action(
            'init',
            function () use ($shortcodes) {
                foreach ($shortcodes as $shortcode) {
                    if ($shortcode instanceof ConditionAwareInterface && $shortcode->hasConditions()) {
                        $evaluated = true;
                        foreach ($shortcode->getConditions() as $condition) {
                            if ($condition->evaluate() === false) {
                                $evaluated = false;
                                break;
                            }
                        }
                        if (!$evaluated) {
                            continue;
                        }
                        $this->registerShortcode($shortcode);
                    } else {
                        $this->registerShortcode($shortcode);
                    }
                }
            }
        );
    }

    /**
     * @param ShortcodeInterface $shortcode
     */
    private function registerShortcode(ShortcodeInterface $shortcode)
    {
        add_shortcode($shortcode->getTag(), [$shortcode, 'callback']);
    }
}