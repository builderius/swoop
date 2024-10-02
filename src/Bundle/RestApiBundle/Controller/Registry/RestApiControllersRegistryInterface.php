<?php

namespace Swoop\Bundle\RestApiBundle\Controller\Registry;

interface RestApiControllersRegistryInterface
{
    /**
     * @return \WP_REST_Controller[]
     */
    public function getControllers();
}
