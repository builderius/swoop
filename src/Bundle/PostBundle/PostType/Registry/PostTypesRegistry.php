<?php

namespace Swoop\Bundle\PostBundle\PostType\Registry;

use Swoop\Bundle\PostBundle\PostType\PostTypeInterface;

class PostTypesRegistry implements PostTypesRegistryInterface
{
    /**
     * @var PostTypeInterface[]
     */
    private $postTypes = [];

    /**
     * @param PostTypeInterface $postType
     */
    public function addPostType(PostTypeInterface $postType)
    {
        $this->postTypes[$postType->getType()] = $postType;
    }

    /**
     * @inheritDoc
     */
    public function getPostTypes()
    {
        return $this->postTypes;
    }

    /**
     * @inheritDoc
     */
    public function getPostType($type)
    {
        if ($this->hasPostType($type)) {
            return $this->postTypes[$type];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasPostType($type)
    {
        return isset($this->postTypes[$type]);
    }
}
