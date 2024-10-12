<?php

namespace Swoop\Bundle\PostBundle\PostType\Processor;

use Swoop\Bundle\PostBundle\PostType\PostTypeInterface;

interface PostTypesProcessorInterface
{
    /**
     * @param PostTypeInterface[] $postTypes
     */
    public function registerPostTypes(array $postTypes);
}
