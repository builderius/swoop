<?php

namespace Swoop\Bundle\MetaBoxBundle\Processor;

use Swoop\Bundle\MetaBoxBundle\Model\MetaBoxInterface;

interface MetaBoxesProcessorInterface
{
    /**
     * @param MetaBoxInterface[] $metaBoxes
     */
    public function registerMetaBoxes(array $metaBoxes);
}
