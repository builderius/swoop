<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

class AdminStyleInlineAssetsProcessorChainElement extends FrontendStyleInlineAssetsProcessorChainElement
{
    /**
     * @var string
     */
    protected $assetRegistrationFunction = 'admin_head';
    /**
     * @var string
     */
    protected $registrationFunction = 'admin_enqueue_scripts';
}
