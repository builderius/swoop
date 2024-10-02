<?php

namespace Swoop\Bundle\CronBundle\Scheduler\Chain\Element;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\CronBundle\Model\CronCommandInterface;
use Swoop\Bundle\CronBundle\Scheduler\CronCommandsSchedulerInterface;
use Swoop\Bundle\HookBundle\Registry\HooksRegistryInterface;
use Swoop\Bundle\KernelBundle\Bundle\BundleInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractCronCommandsSchedulerChainElement implements
    CronCommandsSchedulerInterface,
    CronCommandsSchedulerChainElementInterface
{
    /**
     * @var array
     */
    private $bundles;

    /**
     * @var HooksRegistryInterface
     */
    protected $hooksRegistry;

    /**
     * @var CronCommandsSchedulerChainElementInterface|null
     */
    private $successor;

    /**
     * @param ContainerInterface $container
     * @param HooksRegistryInterface $hooksRegistry
     */
    public function __construct(ContainerInterface $container, HooksRegistryInterface $hooksRegistry)
    {
        $this->bundles = $container->get('kernel')->getBundles();
        $this->hooksRegistry = $hooksRegistry;
    }

    /**
     * @inheritDoc
     */
    public function scheduleCommands(array $commands)
    {
        if (!empty($commands)) {
            foreach ($commands as $command) {
                $commandClass = get_class($command);
                $filteredBundles = array_filter($this->bundles, function (BundleInterface $bundle) use ($commandClass) {
                    if (strpos($commandClass, $bundle->getNamespace()) !== false) {
                        return true;
                    }

                    return false;
                });
                /** @var BundleInterface $commandBundle */
                $commandBundle = reset($filteredBundles);
                if ($command instanceof ConditionAwareInterface && $command->hasConditions()) {
                    $evaluated = true;
                    foreach ($command->getConditions() as $condition) {
                        if ($condition->evaluate() === false) {
                            $evaluated = false;
                            break;
                        }
                    }
                    if (!$evaluated) {
                        continue;
                    }
                    $this->scheduleCommand($command, $commandBundle->getPluginName());
                } else {
                    $this->scheduleCommand($command, $commandBundle->getPluginName());
                }
            }
        }
    }

    /**
     * @param CronCommandInterface $command
     * @param string $pluginBaseName
     */
    private function scheduleCommand(CronCommandInterface $command, $pluginBaseName)
    {
        if ($this->isApplicable($command)) {
            $this->schedule($command, $pluginBaseName);
        } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($command)) {
            $this->getSuccessor()->schedule($command, $pluginBaseName);
        }
    }

    /**
     * @param CronCommandsSchedulerChainElementInterface $successor
     */
    public function setSuccessor(CronCommandsSchedulerChainElementInterface $successor)
    {
        $this->successor = $successor;
    }

    /**
     * @return CronCommandsSchedulerChainElementInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}