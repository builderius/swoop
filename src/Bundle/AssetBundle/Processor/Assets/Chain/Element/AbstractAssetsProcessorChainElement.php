<?php

namespace Swoop\Bundle\AssetBundle\Processor\Assets\Chain\Element;

use Swoop\Bundle\AssetBundle\Event\AssetsContainingEvent;
use Swoop\Bundle\AssetBundle\Model\AssetInterface;
use Swoop\Bundle\AssetBundle\Path\AssetPathProviderInterface;
use Swoop\Bundle\AssetBundle\Processor\Assets\AssetsProcessorInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractAssetsProcessorChainElement implements
    AssetsProcessorInterface,
    AssetsProcessorChainElementInterface
{
    protected string $registrationFunction = 'wp_enqueue_scripts';
    private ?AssetsProcessorChainElementInterface $successor;

    /**
     * @param AssetPathProviderInterface $pathProvider
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        protected AssetPathProviderInterface $pathProvider,
        protected EventDispatcherInterface $eventDispatcher
    ) {
    }

    public function setRegistrationFunction(string $registrationFunction): static
    {
        $this->registrationFunction = $registrationFunction;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function registerAssets(array $assets): void
    {
        add_action(
            $this->registrationFunction,
            function () use ($assets) {
                $event = new AssetsContainingEvent($assets);
                $this->eventDispatcher->dispatch($event, 'wp_assets_before_registration');
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
            20
        );
    }

    public function registerAsset(AssetInterface $asset): void
    {
        if ($this->isApplicable($asset)) {
            $this->register($asset);
        } elseif ($this->getSuccessor() && $this->getSuccessor()->isApplicable($asset)) {
            $this->getSuccessor()->register($asset);
        }
    }

    public function setSuccessor(AssetsProcessorChainElementInterface $assetProcessor): static
    {
        $this->successor = $assetProcessor;

        return $this;
    }

    protected function getSuccessor(): ?AssetsProcessorChainElementInterface
    {
        return $this->successor;
    }
}
