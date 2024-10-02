<?php

namespace Swoop\Bundle\CronBundle\Scheduler;

use Swoop\Bundle\CronBundle\Model\CronCommandInterface;

interface CronCommandsSchedulerInterface
{
    /**
     * @param CronCommandInterface[] $commands
     * @return void
     */
    public function scheduleCommands(array $commands);
}