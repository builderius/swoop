<?php

namespace Swoop\Bundle\AssetBundle\Model;

interface AssetInterface
{
    const FRONTEND_CATEGORY = 'frontend';
    const ADMIN_CATEGORY = 'admin';

    public function registerOnly(): bool;
    public function getHandle(): string;
    public function getSource(): string;
    public function getDependencies(): array;
    public function getVersion(): string;
    public function getCategory(): string;

    /**
     * @return AssetDataItemInterface[]
     */
    public function getAssetData(): array;

    public function addAssetDataItem(AssetDataItemInterface $dataItem): static;
}
