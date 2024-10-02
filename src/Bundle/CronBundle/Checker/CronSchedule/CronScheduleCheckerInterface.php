<?php

namespace Swoop\Bundle\CronBundle\Checker\CronSchedule;

use Swoop\Bundle\CronBundle\Model\CronScheduleInterface;

interface CronScheduleCheckerInterface
{
    /**
     * @param CronScheduleInterface $schedule
     * @return boolean
     */
    public function check(CronScheduleInterface $schedule);
}
