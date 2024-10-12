<?php

namespace Swoop\Bundle\WpCliBundle\Processor;

use Swoop\Bundle\WpCliBundle\Model\WpCliCommandInterface;

class WpCliCommandsProcessor implements WpCliCommandsProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function registerCommands(array $commands)
    {
        add_action('cli_init', function () use ($commands) {
            foreach ($commands as $command) {
                if ($command instanceof WpCliCommandInterface) {
                    \WP_CLI::add_command(
                        $command->getName(),
                        [$command, 'execute'],
                        $command->getAdditionalRegistrationParameters()
                    );
                }
            }
        });
    }
}
