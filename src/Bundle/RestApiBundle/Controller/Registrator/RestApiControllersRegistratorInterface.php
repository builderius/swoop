<?php

namespace Swoop\Bundle\RestApiBundle\Controller\Registrator;

interface RestApiControllersRegistratorInterface
{
    /**
     * @param \WP_REST_Controller[] $restControllers
     */
    public function registerRestControllers(array $restControllers);
}
