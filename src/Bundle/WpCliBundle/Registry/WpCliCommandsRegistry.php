<?php

namespace Swoop\Bundle\WpCliBundle\Registry;

use Swoop\Bundle\WpCliBundle\Model\WpCliCommandInterface;

class WpCliCommandsRegistry implements WpCliCommandsRegistryInterface
{
    /**
     * @var WpCliCommandInterface[]
     */
    private $commands = [];

    /**
     * @param WpCliCommandInterface $command
     */
    public function addCommand(WpCliCommandInterface $command)
    {
        $this->commands[$command->getName()] = $command;
    }

    /**
     * @inheritDoc
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @inheritDoc
     */
    public function getCommand($name)
    {
        if ($this->hasCommand($name)) {
            return $this->commands[$name];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasCommand($name)
    {
        return isset($this->commands[$name]);
    }
}
