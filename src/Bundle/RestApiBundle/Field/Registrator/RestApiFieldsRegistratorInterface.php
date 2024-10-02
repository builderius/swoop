<?php

namespace Swoop\Bundle\RestApiBundle\Field\Registrator;

use Swoop\Bundle\RestApiBundle\Field\RestApiFieldProviderInterface;

interface RestApiFieldsRegistratorInterface
{
    /**
     * @param RestApiFieldProviderInterface[] $fieldProviders
     * @throws \InvalidArgumentException
     */
    public function registerFields(array $fieldProviders);
}
