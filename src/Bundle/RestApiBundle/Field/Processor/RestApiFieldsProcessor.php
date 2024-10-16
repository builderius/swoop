<?php

namespace Swoop\Bundle\RestApiBundle\Field\Processor;

use Swoop\Bundle\RestApiBundle\Field\RestApiFieldProviderInterface;

class RestApiFieldsProcessor implements RestApiFieldsProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function registerFields(array $fieldProviders)
    {
        add_action('rest_api_init', function () use ($fieldProviders) {
            foreach ($fieldProviders as $provider) {
                $this->registerRestApiField($provider);
            }
        });
    }

    /**
     * @param RestApiFieldProviderInterface $provider
     */
    private function registerRestApiField(RestApiFieldProviderInterface $provider)
    {
        register_rest_field(
            $provider->getObjectType(),
            $provider->getAttribute(),
            [
                'get_callback' => [$provider, 'getGetCallback'],
                'update_callback' =>  [$provider, 'getUpdateCallback'],
                'schema' => [$provider, 'getSchema']
            ]
        );
    }
}
