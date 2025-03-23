<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface InlineAssetInterface
{
    const FRONTEND_CATEGORY = 'frontend';
    const ADMIN_CATEGORY = 'admin';

    public function getType(): string;

    public function setType(string $type): static;

    public function getTagType(): string;

    public function setTagType(string $tagType): static;

    public function getContent(): string;

    public function setContent(string $content): static;

    public function getId(): ?string;

    public function setId(string $id): static;

    public function getCategory(): string;

    public function setCategory(string $category): static;

    public function getDependencies(): array;

    public function setDependencies(array $dependencies): static;

    /**
     * @return AssetDataItemInterface[]
     */
    public function getAssetData(): array;

    public function addAssetDataItem(AssetDataItemInterface $dataItem): static;
}
