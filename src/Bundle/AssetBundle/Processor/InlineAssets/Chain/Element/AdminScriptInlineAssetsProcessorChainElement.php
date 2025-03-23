<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

class AdminScriptInlineAssetsProcessorChainElement extends FrontendScriptInlineAssetsProcessorChainElement
{
    protected ?string $assetRegistrationFunction = 'admin_footer';
    protected ?string $registrationFunction = 'admin_enqueue_scripts';
}
