<?php

namespace Swoop\Bundle\HookBundle\Processor\Chain\Element;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\HookBundle\Model\HookInterface;
use Swoop\Bundle\HookBundle\Processor\HooksProcessorInterface;

abstract class AbstractHooksProcessorChainElement implements
    HooksProcessorInterface,
    HooksProcessorChainElementInterface
{
    /**
     * @var HooksProcessorChainElementInterface|null
     */
    private $successor;

    /**
     * @inheritDoc
     */
    public function registerHooks(array $hooks)
    {
        $groupedHooksWithoutInitHook = [];
        $groupedHooksWithInitHook = [];
        foreach ($hooks as $hook) {
            if ($hook->getInitHookName()) {
                $groupedHooksWithInitHook[$hook->getInitHookName()][$hook->getInitHookPriority()][] = $hook;
            } else {
                $groupedHooksWithoutInitHook[] = $hook;
            }
        }
        $this->registerHooksWithoutInitHook($groupedHooksWithoutInitHook);
        foreach ($groupedHooksWithInitHook as $initHookName => $hooksByInitPriority) {
            foreach ($hooksByInitPriority as $initHookPriority => $hooksWithoutInitHook) {
                $this->registerHooksWithInitHook($initHookName, $initHookPriority, $hooksWithoutInitHook);
            }
        }
    }

    /**
     * @param HookInterface[] $hooks
     */
    private function registerHooksWithoutInitHook(array $hooks)
    {
        foreach ($hooks as $hook) {
            if ($hook instanceof ConditionAwareInterface && $hook->hasConditions()) {
                $evaluated = true;
                foreach ($hook->getNotLazyConditions() as $condition) {
                    if ($condition->evaluate() === false) {
                        $evaluated = false;
                        break;
                    }
                }
                if (!$evaluated) {
                    continue;
                }
                $this->registerHook($hook);
            } else {
                $this->registerHook($hook);
            }
        }
    }

    /**
     * @param string $initHookName
     * @param int $initHookPriority
     * @param HookInterface[] $hooks
     */
    private function registerHooksWithInitHook($initHookName, $initHookPriority, array $hooks)
    {
        add_action(
            $initHookName,
            function () use ($hooks) {
                foreach ($hooks as $hook) {
                    if ($hook instanceof ConditionAwareInterface && $hook->hasConditions()) {
                        $evaluated = true;
                        foreach ($hook->getNotLazyConditions() as $condition) {
                            if ($condition->evaluate() === false) {
                                $evaluated = false;
                                break;
                            }
                        }
                        if (!$evaluated) {
                            continue;
                        }
                        $this->registerHook($hook);
                    } else {
                        $this->registerHook($hook);
                    }
                }
            },
            $initHookPriority
        );
    }

    /**
     * @param HookInterface $hook
     */
    private function registerHook(HookInterface $hook)
    {
        if ($this->isApplicable($hook)) {
            $this->register($hook);
        } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($hook)) {
            $this->getSuccessor()->register($hook);
        }
    }

    /**
     * @param HooksProcessorChainElementInterface $hookProcessor
     */
    public function setSuccessor(HooksProcessorChainElementInterface $hookProcessor)
    {
        $this->successor = $hookProcessor;
    }

    /**
     * @return HooksProcessorChainElementInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}
