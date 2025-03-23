<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

class AdminStyleInlineAssetsProcessorChainElement extends FrontendStyleInlineAssetsProcessorChainElement
{
    protected ?string $assetRegistrationFunction = 'admin_head';
    protected ?string $registrationFunction = 'admin_enqueue_scripts';
}
