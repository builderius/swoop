<?php

namespace Swoop\Bundle\MetaBoxBundle\Registry;

use Swoop\Bundle\MetaBoxBundle\Model\MetaBoxInterface;

interface MetaBoxesRegistryInterface
{
    /**
     * @return MetaBoxInterface[]
     */
    public function getMetaBoxes();

    /**
     * @param string $id
     * @return MetaBoxInterface
     */
    public function getMetaBox($id);

    /**
     * @param string $id
     * @return bool
     */
    public function hasMetaBox($id);
}
