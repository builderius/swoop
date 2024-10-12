<?php

namespace Swoop\Bundle\ShortcodeBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\ShortcodeBundle\Processor\ShortcodesProcessorInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ShortcodeBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        /** @var ContainerBuilder $container */
        $container->addCompilerPass(
            new KernelCompilerPass(
                'wp_shortcode',
                'swoop_shortcode.processor.shortcodes',
                'addShortcode'
            )
        );
    }
    
    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var ShortcodesProcessorInterface $shortcodesProcessor */
        $shortcodesProcessor = $this->container->get('swoop_shortcode.processor.shortcodes');
        $shortcodesProcessor->registerShortcodes();

        parent::boot();
    }
}
