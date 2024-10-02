<?php

namespace Swoop\Bundle\CronBundle\Model;

interface CronRecurrentCommandInterface extends CronCommandInterface
{
    /**
     * @return string
     */
    public function getRecurrence();
}