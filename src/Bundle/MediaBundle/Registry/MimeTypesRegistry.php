<?php

namespace Swoop\Bundle\MediaBundle\Registry;

use Swoop\Bundle\MediaBundle\Model\MimeType;
use Swoop\Bundle\MediaBundle\Model\MimeTypeInterface;

class MimeTypesRegistry implements MimeTypesRegistryInterface
{
    /**
     * @var MimeTypeInterface[]
     */
    private $mimeTypes = [];

    /**
     * @inheritDoc
     */
    public function getMimeTypes()
    {
        if (empty($this->mimeTypes)) {
            foreach (get_allowed_mime_types() as $extension => $type) {
                $this->mimeTypes[$extension] = new MimeType([
                    MimeType::EXTENSION_FIELD => $extension,
                    MimeType::MIME_TYPE_FIELD => $type
                ]);
            }
        }

        return $this->mimeTypes;
    }

    /**
     * @inheritDoc
     */
    public function getMimeType($extension)
    {
        if ($this->hasMimeType($extension)) {
            return $this->getMimeTypes()[$extension];
        }
        
        return null;
    }

    /**
     * @inheritDoc
     */
    public function hasMimeType($extension)
    {
        $mimeTypes = $this->getMimeTypes();
        if (isset($mimeTypes[$extension])) {
            return true;
        }
        
        return false;
    }
}
