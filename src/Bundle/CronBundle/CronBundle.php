<?php

namespace Swoop\Bundle\CronBundle;

use Swoop\Bundle\CronBundle\Registry\CronCommandsRegistryInterface;
use Swoop\Bundle\CronBundle\Scheduler\CronCommandsSchedulerInterface;
use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CronBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_cron_schedule',
                'swoop_cron.hook.cron_schedules_registration',
                'addCronSchedule'
            )
        );
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_cron_command',
                'swoop_cron.registry.cron_commands',
                'addCronCommand'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var CronCommandsRegistryInterface $commandsRegistry */
        $commandsRegistry = $this->container->get('swoop_cron.registry.cron_commands');
        /** @var CronCommandsSchedulerInterface $commandsScheduler */
        $commandsScheduler = $this->container->get('swoop_cron.scheduler.cron_commands');
        $commandsScheduler->scheduleCommands($commandsRegistry->getCronCommands());

        parent::boot();
    }
}
