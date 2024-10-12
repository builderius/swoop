<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

class AdminScriptInlineAssetsProcessorChainElement extends FrontendScriptInlineAssetsProcessorChainElement
{
    /**
     * @var string
     */
    protected $assetRegistrationFunction = 'admin_footer';
    /**
     * @var string
     */
    protected $registrationFunction = 'admin_enqueue_scripts';
}
