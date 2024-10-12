<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

use Swoop\Bundle\AssetBundle\Event\InlineAssetsContainingEvent;
use Swoop\Bundle\AssetBundle\Formatter\HtmlAttributesFormatter;
use Swoop\Bundle\AssetBundle\Processor\InlineAssets\InlineAssetsProcessorInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractInlineAssetsProcessorChainElement implements
    InlineAssetsProcessorInterface,
    InlineAssetsProcessorChainElementInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var string
     */
    protected $assetRegistrationFunction = null;

    /**
     * @var string
     */
    protected $registrationFunction = null;

    /**
     * @var InlineAssetsProcessorChainElementInterface|null
     */
    private $successor;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @inheritDoc
     */
    public function registerAssets(array $assets)
    {
        add_action($this->registrationFunction, function () use ($assets) {
            $event = new InlineAssetsContainingEvent($assets);
            $this->eventDispatcher->dispatch($event, 'wp_inline_assets_before_dependencies_registration');
            foreach ($event->getAssets() as $asset) {
                if (!empty($asset->getDependencies())) {
                    if ($asset instanceof ConditionAwareInterface && $asset->hasConditions()) {
                        $evaluated = true;
                        foreach ($asset->getConditions() as $condition) {
                            if ($condition->evaluate() === false) {
                                $evaluated = false;
                                break;
                            }
                        }
                        if (!$evaluated) {
                            continue;
                        }
                        $this->enqueueDependency($asset);
                    } else {
                        $this->enqueueDependency($asset);
                    }
                }
            }
        });
        $assetsByTypes = [];
        foreach (static::ASSETS_TYPES as $possibleAssetType) {
            $assetsByTypes[$possibleAssetType] = [];
        }
        foreach ($assets as $asset) {
            $assetsByTypes[$asset->getType()][] = $asset;
        }
        foreach ($assetsByTypes as $type => $assets) {
            if ($this->isApplicable($type)) {
                $this->registerAssetsByType($type, $assets);
            } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($type)) {
                $this->getSuccessor()->registerAssetsByType($type, $assets);
            }
        }

    }

    /**
     * @param $type
     * @param $assets
     */
    public function registerAssetsByType($type, $assets)
    {
        if ($this->isApplicable($type)) {
            add_action(
                $this->assetRegistrationFunction,
                function () use ($type, $assets) {
                    $event = new InlineAssetsContainingEvent($assets);
                    $this->eventDispatcher->dispatch($event, sprintf('wp_inline_assets_before_%ss_registration', $type));
                    foreach ($event->getAssets() as $asset) {
                        if ($asset instanceof ConditionAwareInterface && $asset->hasConditions()) {
                            $evaluated = true;
                            foreach ($asset->getConditions() as $condition) {
                                if ($condition->evaluate() === false) {
                                    $evaluated = false;
                                    break;
                                }
                            }
                            if (!$evaluated) {
                                continue;
                            }
                            $this->registerAsset($asset);
                        } else {
                            $this->registerAsset($asset);
                        }
                    }
                },
                30
            );
        } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($type)) {
            $this->registerAssetsByType($type, $assets);
        }
    }

    /**
     * @param array $htmlAttributes
     * @return string
     */
    protected function generateHtmlAttributes(array $htmlAttributes)
    {
        $formattedAttributes = [];
        foreach ($htmlAttributes as $key => $value) {
            $formattedAttributes[] = HtmlAttributesFormatter::format($key, $value);
        }
        if (!empty($formattedAttributes)) {
            return implode(' ', $formattedAttributes);
        }

        return '';
    }

    /**
     * @param InlineAssetsProcessorChainElementInterface $assetProcessor
     */
    public function setSuccessor(InlineAssetsProcessorChainElementInterface $assetProcessor)
    {
        $this->successor = $assetProcessor;
    }

    /**
     * @return InlineAssetsProcessorChainElementInterface|null
     */
    protected function getSuccessor()
    {
        return $this->successor;
    }
}
