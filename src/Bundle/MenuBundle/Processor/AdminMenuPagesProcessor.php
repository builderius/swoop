<?php

namespace Swoop\Bundle\MenuBundle\Processor;

use Exception;
use Swoop\Bundle\ConditionBundle\Model\ConditionAwareInterface;
use Swoop\Bundle\MenuBundle\Model\AdminMenuPageInterface;
use Swoop\Bundle\MenuBundle\Model\MenuElementInterface;
use Swoop\Bundle\PageBundle\Registry\PagesRegistryInterface;

class AdminMenuPagesProcessor implements MenuElementsProcessorInterface
{
    /**
     * @var PagesRegistryInterface
     */
    private $pagesRegistry;

    /**
     * @param PagesRegistryInterface $pagesRegistry
     */
    public function __construct(PagesRegistryInterface $pagesRegistry)
    {
        $this->pagesRegistry = $pagesRegistry;
    }

    /**
     * @param AdminMenuPageInterface[]|MenuElementInterface[] $menuElements
     * @inheritDoc
     */
    public function register(array $menuElements)
    {
        add_action(
            'init',
            function () use ($menuElements) {
                foreach ($menuElements as $menuElement) {
                    if (!$menuElement instanceof AdminMenuPageInterface) {
                        throw new Exception('AdminMenuPagesProcessor can register just AdminMenuPageInterface');
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
                            return;
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
     * @param AdminMenuPageInterface $menuElement
     */
    private function addNode(AdminMenuPageInterface $menuElement)
    {
        $iconUrl = $menuElement->getIconUrl() ?: '';
        $function = $menuElement->getPage() ?
            [$this->pagesRegistry->getPage($menuElement->getPage()), 'render'] : '';
        add_action('admin_menu', function () use ($menuElement, $iconUrl, $function) {
            if (!$menuElement->getParent()) {
                add_menu_page(
                    $menuElement->getPageTitle(),
                    $menuElement->getTitle(),
                    $menuElement->getCapability(),
                    $menuElement->getMenuSlug(),
                    $function,
                    $iconUrl,
                    $menuElement->getPosition()
                );
            } else {
                add_submenu_page(
                    $menuElement->getParent(),
                    $menuElement->getPageTitle(),
                    $menuElement->getTitle(),
                    $menuElement->getCapability(),
                    $menuElement->getMenuSlug(),
                    $function,
                    $menuElement->getPosition()
                );
            }
        });
    }
}
