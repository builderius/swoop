<?php

namespace Swoop\Bundle\AssetBundle\Registrator\Assets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\AssetInterface;
use Swoop\Bundle\AssetBundle\Model\StyleInterface;

class StyleAssetsRegistratorChainElement extends AbstractAssetsRegistratorChainElement
{
    /**
     * @inheritDoc
     */
    public function isApplicable(AssetInterface $asset)
    {
        return $asset instanceof StyleInterface;
    }

    /**
     * @inheritDoc
     */
    public function register(AssetInterface $asset)
    {
        /** @var StyleInterface $asset */
        if ($asset->registerOnly()) {
            wp_register_style(
                $asset->getHandle(),
                $this->pathProvider->getAssetPath($asset),
                $asset->getDependencies(),
                $asset->getVersion(),
                $asset->getMedia() ?: 'all'
            );
        } else {
            wp_enqueue_style(
                $asset->getHandle(),
                $this->pathProvider->getAssetPath($asset),
                $asset->getDependencies(),
                $asset->getVersion(),
                $asset->getMedia() ?: 'all'
            );
        }
        if (!empty($asset->getAssetData())) {
            $groupedData = [];
            foreach ($asset->getAssetData() as $dataItem) {
                $groupedData[$dataItem->getGroup()][$dataItem->getKey()] = $dataItem->getValue();
            }
            foreach ($groupedData as $group => $values) {
                wp_style_add_data($asset->getHandle(), $group, $values);
            }
        }
    }
}
