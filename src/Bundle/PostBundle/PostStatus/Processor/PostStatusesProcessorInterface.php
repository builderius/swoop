<?php

namespace Swoop\Bundle\PostBundle\PostStatus\Processor;

use Swoop\Bundle\PostBundle\PostStatus\PostStatusInterface;

interface PostStatusesProcessorInterface
{
    /**
     * @param PostStatusInterface[] $postStatuses
     */
    public function registerPostStatuses(array $postStatuses);
}
