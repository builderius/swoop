<?php

namespace Swoop\Bundle\TaxonomyBundle\Registrator;

use Swoop\Bundle\TaxonomyBundle\Model\TaxonomyInterface;

interface TaxonomiesRegistratorInterface
{
    /**
     * @param TaxonomyInterface[] $taxonomies
     */
    public function registerTaxonomies(array $taxonomies);
}
