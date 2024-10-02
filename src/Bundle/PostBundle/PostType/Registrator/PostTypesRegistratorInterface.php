<?php

namespace Swoop\Bundle\PostBundle\PostType\Registrator;

use Swoop\Bundle\PostBundle\PostType\PostTypeInterface;

interface PostTypesRegistratorInterface
{
    /**
     * @param PostTypeInterface[] $postTypes
     */
    public function registerPostTypes(array $postTypes);
}
