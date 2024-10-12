<?php

namespace Swoop\Bundle\MediaBundle\Processor;

use Swoop\Bundle\MediaBundle\Model\MimeTypeInterface;

class MimeTypesProcessor implements MimeTypesProcessorInterface
{
    /**
     * @var MimeTypeInterface[]
     */
    private $mimeTypes = [];

    /**
     * @param MimeTypeInterface $mimeType
     * @return $this
     */
    public function addMimeType(MimeTypeInterface $mimeType)
    {
        $this->mimeTypes[$mimeType->getExtension()] = $mimeType;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerMimeTypes()
    {
        $mimeTypes = $this->mimeTypes;
        add_filter('upload_mimes', function ($existingMimes) use ($mimeTypes) {
            foreach ($mimeTypes as $mimeType) {
                $existingMimes[$mimeType->getExtension()] = $mimeType->getMimeType();
            }

            return $existingMimes;
        });
    }
}
