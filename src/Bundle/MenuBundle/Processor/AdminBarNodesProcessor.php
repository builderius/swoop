<?php

namespace Swoop\Bundle\MenuBundle\Processor;

use Exception;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\MenuBundle\Model\AdminBarNodeInterface;
use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;
use WP_Admin_Bar;

class AdminBarNodesProcessor implements MenuElementsProcessorInterface
{
    /**
     * @param AdminBarNodeInterface[]|MenuElementInterface[] $menuElements
     * @inheritDoc
     */
    public function register(array $menuElements)
    {
        add_action(
            'init',
            function () use ($menuElements) {
                foreach ($menuElements as $menuElement) {
                    if (!$menuElement instanceof AdminBarNodeInterface) {
                        throw new Exception('AdminBarNodesProcessor can register just AdminBarNodeInterface');
                    }
                    if ($menuElement instanceof ConditionAwareInterface && $menuElement->hasConditions()) {
                        $evaluated = true;
                        foreach ($menuElement->getConditions() as $condition) {
                            if ($condition->evaluate() === false) {
                                $evaluated = false;
                                break;
                            }
                        }
                        if (!$evaluated) {
                            continue;
                        }
                        $this->addNode($menuElement);
                    } else {
                        $this->addNode($menuElement);
                    }
                }
            }
        );
    }

    /**
     * @param AdminBarNodeInterface $menuElement
     */
    private function addNode(AdminBarNodeInterface $menuElement)
    {
        add_action(
            'admin_bar_menu',
            function (WP_Admin_Bar $wp_admin_bar) use ($menuElement) {
                $wp_admin_bar->add_node(
                    [
                        'parent' => $menuElement->getParent(),
                        'id' => $menuElement->getIdentifier(),
                        'title' => $menuElement->getTitle(),
                        'href' => $menuElement->getHref(),
                        'meta' => $menuElement->getMeta(),
                        'group' => $menuElement->isGroup()
                    ]
                );
            },
            1000
        );
    }
}
