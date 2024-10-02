<?php

namespace Swoop\Bundle\CronBundle\Registry;

use Swoop\Bundle\CronBundle\Model\CronCommandInterface;

interface CronCommandsRegistryInterface
{
    /**
     * @return CronCommandInterface[]
     */
    public function getCronCommands();

    /**
     * @param string $name
     * @return CronCommandInterface
     */
    public function getCronCommand($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasCronCommand($name);
}