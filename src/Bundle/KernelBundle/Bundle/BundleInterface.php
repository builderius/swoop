<?php

namespace Swoop\Bundle\KernelBundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

interface BundleInterface extends ContainerAwareInterface
{
    /**
     * Boots the Bundle.
     */
    public function boot(): void;

    /**
     * Shutdowns the Bundle.
     */
    public function shutdown(): void;

    /**
     * Builds the bundle.
     */
    public function build(ContainerBuilder $container): void;

    /**
     * Returns the container extension that should be implicitly loaded.
     */
    public function getContainerExtension(): ?ExtensionInterface;

    /**
     * Returns the bundle name (the class short name).
     */
    public function getName(): string;

    /**
     * Gets the Bundle namespace.
     */
    public function getNamespace(): string;

    /**
     * Gets the Bundle directory path.
     *
     * The path should always be returned as a Unix path (with /).
     */
    public function getPath(): string;

    /**
     * Gets the Plugin name.
     */
    public function getPluginName(): string;
}
