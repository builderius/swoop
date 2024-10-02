<?php

namespace Swoop\Bundle\WpCliBundle\Registrator;

use Swoop\Bundle\WpCliBundle\Model\WpCliCommandInterface;

interface WpCliCommandsRegistratorInterface
{
    /**
     * @param WpCliCommandInterface[] $commands
     */
    public function registerCommands(array $commands);
}
