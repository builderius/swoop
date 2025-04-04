<?php

namespace Swoop\Bundle\MediaBundle\Processor;

use Swoop\Bundle\MediaBundle\Model\ImageSizeInterface;

class ImageSizesProcessor implements ImageSizesProcessorInterface
{
    /**
     * @var ImageSizeInterface[]
     */
    private $imageSizes = [];

    /**
     * @param ImageSizeInterface $imageSize
     * @return $this
     */
    public function addImageSize(ImageSizeInterface $imageSize)
    {
        $this->imageSizes[$imageSize->getName()] = $imageSize;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerImageSizes()
    {
        $imageSizes = $this->imageSizes;
        add_action('after_setup_theme', function () use ($imageSizes) {
            foreach ($imageSizes as $imageSize) {
                add_image_size(
                    $imageSize->getName(),
                    $imageSize->getWidth(),
                    $imageSize->getHeight(),
                    $imageSize->getCrop()
                );
            }
        });
    }
}
