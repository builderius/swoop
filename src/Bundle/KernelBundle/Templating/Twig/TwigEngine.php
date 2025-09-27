<?php

namespace Swoop\Bundle\KernelBundle\Templating\Twig;

use Swoop\Bundle\KernelBundle\Templating\TemplateNameParser;
use Twig\Environment;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Twig\Template;

class TwigEngine
{
    protected $environment;
    protected $parser;

    public function __construct(Environment $environment, TemplateNameParser $parser)
    {
        $this->environment = $environment;
        $this->parser = $parser;
    }

    /**
     * @inheritDoc
     */
    public function render($name, array $parameters = array())
    {
        $parsedTemplate = $this->parser->parse($name);
        $absoluteName = $parsedTemplate['logicalName'];
        $filename = \substr(\strrchr($absoluteName, "/"), 1);
        /** @var FilesystemLoader $loader */
        $loader = $this->environment->getLoader();
        $loader->setPaths([\dirname($absoluteName)]);
        return $this->environment->render($filename, $parameters);
    }

    /**
     * @inheritDoc
     *
     * It also supports Template as name parameter.
     *
     * @throws Error if something went wrong like a thrown exception while rendering the template
     */
    public function stream($name, array $parameters = array())
    {
        $this->load($name)->display($parameters);
    }

    /**
     * @inheritDoc
     *
     * It also supports Template as name parameter.
     */
    public function exists($name)
    {
        if ($name instanceof Template) {
            return true;
        }

        $loader = $this->environment->getLoader();

        if ($loader instanceof ExistsLoaderInterface || method_exists($loader, 'exists')) {
            return $loader->exists((string) $name);
        }

        try {
            // cast possible TemplateReferenceInterface to string because the
            // EngineInterface supports them but LoaderInterface does not
            $loader->getSourceContext((string) $name)->getCode();
        } catch (LoaderError $e) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     *
     * It also supports Template as name parameter.
     */
    public function supports($name)
    {
        if ($name instanceof Template) {
            return true;
        }

        $template = $this->parser->parse($name);

        return 'twig' === $template['engine'];
    }

    /**
     * Loads the given template.
     *
     * @param string|Template $name A template name or Template instance
     *
     * @return Template
     *
     * @throws \InvalidArgumentException if the template does not exist
     */
    protected function load($name)
    {
        if ($name instanceof Template) {
            return $name;
        }

        try {
            return $this->environment->loadTemplate((string) $name);
        } catch (LoaderError $e) {
            throw new \InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
