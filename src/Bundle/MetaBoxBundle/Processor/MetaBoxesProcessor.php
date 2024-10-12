<?php

namespace Swoop\Bundle\MetaBoxBundle\Processor;

class MetaBoxesProcessor implements MetaBoxesProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function registerMetaBoxes(array $metaBoxes)
    {
        foreach ($metaBoxes as $metaBox) {
            add_action(
                sprintf('add_meta_boxes_%s', $metaBox->getPostType()),
                function () use ($metaBox) {
                    add_meta_box(
                        $metaBox->getId(),
                        $metaBox->getTitle(),
                        [$metaBox, 'render'],
                        $metaBox->getScreen(),
                        $metaBox->getContext(),
                        $metaBox->getPriority(),
                        $metaBox->getRenderArgs()
                    );
                }
            );
            add_action('save_post', [$metaBox, 'save']);
        }
    }
}
