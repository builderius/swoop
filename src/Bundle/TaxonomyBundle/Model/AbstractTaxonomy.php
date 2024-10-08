<?php

namespace Swoop\Bundle\TaxonomyBundle\Model;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareTrait;

abstract class AbstractTaxonomy implements TaxonomyInterface, ConditionAwareInterface
{
    use ConditionAwareTrait;
    
    /**
     * @var TermInterface[]
     */
    protected $terms = [];

    /**
     * @inheritDoc
     */
    public function addTerm(TermInterface $term)
    {
        $term->setTaxonomy($this->getName());
        $this->terms[$term->getName()] = $term;
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTerms()
    {
        return $this->terms;
    }
}
