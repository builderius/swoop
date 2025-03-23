<?php

namespace Swoop\Bundle\AssetBundle\Processor\InlineAssets\Chain\Element;

use Swoop\Bundle\AssetBundle\Model\InlineAssetInterface;

class FrontendStyleInlineAssetsProcessorChainElement extends AbstractInlineAssetsProcessorChainElement
{
    protected ?string $assetRegistrationFunction = 'wp_head';
    protected ?string $registrationFunction = 'wp_enqueue_scripts';

    public function isApplicable(string $assetType): bool
    {
        return 'style' === $assetType;
    }

    public function enqueueDependency(InlineAssetInterface $asset): void
    {
        if (!empty($asset->getDependencies())) {
            $wp_styles = wp_styles();
            foreach ($asset->getDependencies() as $dependency) {
                if (in_array($dependency, array_keys($wp_styles->registered))) {
                    $wp_styles->enqueue($dependency);
                }
            }
        }
    }

    public function registerAsset(InlineAssetInterface $asset): void
    {
        echo $this->getFinalContent($asset);
    }

    protected function getFinalContent(InlineAssetInterface $asset): string
    {
        $htmlAttributes = '';
        if (!empty($asset->getAssetData())) {
            $groupedData = [];
            foreach ($asset->getAssetData() as $dataItem) {
                $groupedData[$dataItem->getGroup()][$dataItem->getKey()] = $dataItem->getValue();
            }
            if (isset($groupedData['htmlAttributes'])) {
                $htmlAttributes = $this->generateHtmlAttributes($groupedData['htmlAttributes']);
            }
        }

        return sprintf(
            '<style%s%s%s>%s</style>',
            $asset->getTagType() ? sprintf(' type="%s"', $asset->getTagType()) : '',
            $asset->getId() ? sprintf(' id="%s"', $asset->getId()) : '',
            $htmlAttributes === '' ? '' : sprintf(' %s', $htmlAttributes),
            $asset->getContent()
        );
    }
}