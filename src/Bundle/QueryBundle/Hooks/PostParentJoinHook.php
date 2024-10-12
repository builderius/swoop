<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostParentJoinHook extends AbstractFilter
{
    const PARENT_TABLE = 'parent_post';

    /**
     * @inheritDoc
     */
    public function getFunction(...$args)
    {
        $join = $args[0];
        $query = $args[1];
        if (isset($query->query[ParentNameInHook::QUERY_ARGUMENT]) ||
            isset($query->query[ParentNameNotInHook::QUERY_ARGUMENT])) {
            global $wpdb;
            $join = sprintf(
                "%s JOIN %s AS %s ON (%s.post_parent = %s.ID) ",
                $wpdb->posts,
                self::PARENT_TABLE,
                $wpdb->posts,
                self::PARENT_TABLE,
                $join
            );
        }
        
        return $join;
    }
}
