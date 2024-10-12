<?php

namespace Swoop\Bundle\TaxonomyBundle\Processor;

use Swoop\Bundle\TaxonomyBundle\Model\TaxonomyInterface;

interface TaxonomiesProcessorInterface
{
    /**
     * @param TaxonomyInterface[] $taxonomies
     */
    public function registerTaxonomies(array $taxonomies);
}
