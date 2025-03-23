<?php

namespace Swoop\Bundle\AssetBundle\Model;

use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareTrait;
use Swoop\Bundle\KernelBundle\ParameterBag\ParameterBag;

class InlineAsset extends ParameterBag implements InlineAssetInterface, ConditionAwareInterface
{
    use ConditionAwareTrait;

    const TYPE_FIELD = 'type';
    const TAG_TYPE_FIELD = 'tagType';
    const ID_FIELD = 'id';
    const CATEGORY_FIELD = 'category';
    const CONTENT_FIELD = 'content';
    const DEPENDENCIES_FIELD = 'dependencies';
    const ASSET_DATA_FIELD = 'assetData';

    public function getType(): string
    {
        return $this->get(self::TYPE_FIELD);
    }

    public function setType(string $type): static
    {
        $this->set(self::TYPE_FIELD, $type);

        return $this;
    }

    public function getTagType(): string
    {
        return $this->get(self::TAG_TYPE_FIELD);
    }

    public function setTagType(string $tagType): static
    {
        $this->set(self::TAG_TYPE_FIELD, $tagType);

        return $this;
    }

    public function getContent(): string
    {
        return $this->get(self::CONTENT_FIELD);
    }

    public function setContent(string $content): static
    {
        $this->set(self::CONTENT_FIELD, $content);

        return $this;
    }

    public function getId(): ?string
    {
        return $this->get(self::ID_FIELD);
    }

    public function setId(string $id): static
    {
        $this->set(self::ID_FIELD, $id);

        return $this;
    }

    public function getCategory(): string
    {
        return $this->get(self::CATEGORY_FIELD, InlineAssetInterface::FRONTEND_CATEGORY);
    }

    public function setCategory(string $category): static
    {
        $this->set(self::CATEGORY_FIELD, $category);
        return $this;
    }

    public function getDependencies(): array
    {
        return $this->get(self::DEPENDENCIES_FIELD, []);
    }

    public function setDependencies(array $dependencies): static
    {
        $this->set(self::DEPENDENCIES_FIELD, $dependencies);

        return $this;
    }

    /**
     * @inheritDoc
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
