<?php

namespace Swoop\Bundle\CronBundle\Checker\CronCommand;

use Swoop\Bundle\CronBundle\Model\CronCommandInterface;

interface CronCommandCheckerInterface
{
    /**
     * @param CronCommandInterface $command
     * @return boolean
     */
    public function check(CronCommandInterface $command);
}
