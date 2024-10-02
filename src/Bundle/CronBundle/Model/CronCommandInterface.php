<?php

namespace Swoop\Bundle\CronBundle\Model;

interface CronCommandInterface
{
    /**
     * @return int
     */
    public function getTimestamp();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getArguments();

    /**
     * @return void
     */
    public function execute();
}