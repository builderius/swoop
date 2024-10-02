<?php

namespace Swoop\Bundle\MediaBundle\Registry;

use Swoop\Bundle\MediaBundle\Model\ImageSizeInterface;

interface ImageSizesRegistryInterface
{
    /**
     * @return ImageSizeInterface[]
     */
    public function getImageSizes();

    /**
     * @param string $name
     * @return ImageSizeInterface|null
     */
    public function getImageSize($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasImageSize($name);
}
