<?php

namespace Swoop\Bundle\PostBundle\PostStatus\Registry;

use Swoop\Bundle\PostBundle\PostStatus\PostStatusInterface;

interface PostStatusesRegistryInterface
{
    /**
     * @return PostStatusInterface[]
     */
    public function getPostStatuses();

    /**
     * @param string $status
     * @return PostStatusInterface|null
     */
    public function getPostStatus($status);

    /**
     * @param string $status
     * @return bool
     */
    public function hasPostStatus($status);
}
