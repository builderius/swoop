<?php

namespace Swoop\Bundle\AssetBundle\Model;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareTrait;
use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

abstract class AbstractAsset extends ParameterBag  implements AssetInterface, ConditionAwareInterface
{
    use ConditionAwareTrait;

    const REGISTER_ONLY = 'registerOnly';
    const HANDLE_FIELD = 'handle';
    const SOURCE_FIELD = 'source';
    const VERSION_FIELD = 'version';
    const CATEGORY_FIELD = 'category';
    const DEPENDENCIES_FIELD = 'dependencies';
    const ASSET_DATA_FIELD = 'data';

    public function registerOnly(): bool
    {
        return $this->get(self::REGISTER_ONLY, false);
    }

    public function getHandle(): string
    {
        return $this->get(self::HANDLE_FIELD);
    }

    public function getSource(): string
    {
        return $this->get(self::SOURCE_FIELD);
    }

    public function getDependencies(): array
    {
        return $this->get(self::DEPENDENCIES_FIELD, []);
    }

    public function getVersion(): string
    {
        return $this->get(self::VERSION_FIELD);
    }

    public function getCategory(): string
    {
        return $this->get(self::CATEGORY_FIELD);
    }

    /**
     * {@inheritdoc}
     */
    public function getAssetData(): array
    {
        return $this->get(self::ASSET_DATA_FIELD, []);
    }

    public function addAssetDataItem(AssetDataItemInterface $dataItem): static
    {
        $assetData = $this->getAssetData();
        if (!in_array($dataItem, $assetData)) {
            $assetData[$dataItem->getKey()] = $dataItem;
            $this->set(self::ASSET_DATA_FIELD, $assetData);
        }

        return $this;
    }
}
