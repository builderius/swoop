<?php

namespace Swoop\Bundle\OptionBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\OptionBundle\Processor\OptionsProcessorInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OptionBundle extends Bundle
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
                'wp_option',
                'swoop_option.processor.main',
                'addOption'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var OptionsProcessorInterface $optionsProcessor */
        $optionsProcessor = $this->container->get('swoop_option.processor.main');
        $optionsProcessor->registerOptions();

        parent::boot();
    }
}
