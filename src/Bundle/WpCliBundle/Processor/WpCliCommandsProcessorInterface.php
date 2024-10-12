<?php

namespace Swoop\Bundle\WpCliBundle\Processor;

use Swoop\Bundle\WpCliBundle\Model\WpCliCommandInterface;

interface WpCliCommandsProcessorInterface
{
    /**
     * @param WpCliCommandInterface[] $commands
     */
    public function registerCommands(array $commands);
}
