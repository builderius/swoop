<?php

namespace Swoop\Bundle\RestApiBundle\Field\Registry;

use Swoop\Bundle\RestApiBundle\Field\RestApiFieldProviderInterface;

interface RestApiFieldProvidersRegistryInterface
{
    /**
     * @return RestApiFieldProviderInterface[]
     */
    public function getRestApiFieldProviders();
}
