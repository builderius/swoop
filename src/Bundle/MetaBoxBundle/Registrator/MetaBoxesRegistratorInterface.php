<?php

namespace Swoop\Bundle\MetaBoxBundle\Registrator;

use Swoop\Bundle\MetaBoxBundle\Model\MetaBoxInterface;

interface MetaBoxesRegistratorInterface
{
    /**
     * @param MetaBoxInterface[] $metaBoxes
     */
    public function registerMetaBoxes(array $metaBoxes);
}
