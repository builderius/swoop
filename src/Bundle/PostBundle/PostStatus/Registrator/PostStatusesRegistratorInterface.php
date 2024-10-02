<?php

namespace Swoop\Bundle\PostBundle\PostStatus\Registrator;

use Swoop\Bundle\PostBundle\PostStatus\PostStatusInterface;

interface PostStatusesRegistratorInterface
{
    /**
     * @param PostStatusInterface[] $postStatuses
     */
    public function registerPostStatuses(array $postStatuses);
}
