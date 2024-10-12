<?php

namespace Swoop\Bundle\RestApiBundle\Controller\Processor;

interface RestApiControllersProcessorInterface
{
    /**
     * @param \WP_REST_Controller[] $restControllers
     */
    public function registerRestControllers(array $restControllers);
}
