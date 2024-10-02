<?php

namespace Swoop\Bundle\PageBundle\Model;

use Symfony\Component\Templating\EngineInterface;

abstract class AbstractPage implements PageInterface
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @param EngineInterface $templating
     */
    public function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }
}
