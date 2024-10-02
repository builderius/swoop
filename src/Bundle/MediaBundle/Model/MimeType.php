<?php

namespace Swoop\Bundle\MediaBundle\Model;

use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

class MimeType extends ParameterBag implements MimeTypeInterface
{
    const EXTENSION_FIELD = 'extension';
    const MIME_TYPE_FIELD = 'mime_type';

    /**
     * @inheritDoc
     */
    public function getExtension()
    {
        return $this->get(self::EXTENSION_FIELD);
    }

    /**
     * @inheritDoc
     */
    public function getMimeType()
    {
        return $this->get(self::MIME_TYPE_FIELD);
    }
}
