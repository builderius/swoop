<?php

namespace Swoop\Bundle\TaxonomyBundle;

use Swoop\Bundle\KernelBundle\Bundle\Bundle;
use Swoop\Bundle\KernelBundle\DependencyInjection\CompilerPass\KernelCompilerPass;
use Swoop\Bundle\TaxonomyBundle\Registrator\TaxonomiesRegistratorInterface;
use Swoop\Bundle\TaxonomyBundle\Registry\TaxonomiesRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TaxonomyBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new KernelCompilerPass(
                'swoop_taxonomy',
                'swoop_taxonomy.registry.taxonomies',
                'addTaxonomy'
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function boot()
    {
        /** @var TaxonomiesRegistryInterface $restMetaFieldProvidersRegistry */
        $taxonomiesRegistry = $this->container->get('swoop_taxonomy.registry.taxonomies');
        /** @var TaxonomiesRegistratorInterface $taxonomiesRegistrator */
        $taxonomiesRegistrator = $this->container->get('swoop_taxonomy.registrator.taxonomies');
        $taxonomiesRegistrator->registerTaxonomies($taxonomiesRegistry->getTaxonomies());
        
        parent::boot();
    }
}
