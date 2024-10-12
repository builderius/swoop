<?php

namespace Swoop\Bundle\RestApiBundle\Field\Processor;

use Swoop\Bundle\RestApiBundle\Field\RestApiFieldProviderInterface;

interface RestApiFieldsProcessorInterface
{
    /**
     * @param RestApiFieldProviderInterface[] $fieldProviders
     * @throws \InvalidArgumentException
     */
    public function registerFields(array $fieldProviders);
}
